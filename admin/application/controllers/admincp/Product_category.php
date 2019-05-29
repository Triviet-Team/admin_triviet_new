<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //load model item
        $this->load->model('product_m', 'item');
        //load model category_item
        $this->load->model('product_category_m', 'category_item');
    }

    public function index() {
        //kiem tra co thuc hien loc du lieu hay khong
        $input = array();
        $pid = $this->input->get('pid');
        $pid = intval($pid);
        if ($pid > 0) {
            $input['where']['pid'] = $pid;
            $this->data['pid'] = $pid;   
        }
        //get list items
        $list = $this->category_item->get_list($input);
        //get name category parent
        foreach($list as $row) {
            if($row->pid > 0) {
                $obj_category = $this->category_item->get_info($row->pid);
                $row->category_name = $obj_category->vn_name;
            }                       
        }

        $this->data['list'] = $list;       
        $this->data['catalogs'] = $this->category_item->get_list();

        $this->data['title'] = 'Danh mục san phẩm';
        $this->data['temp'] = 'product_category/index';
        $this->load->view('admin/main', $this->data);
    }

    public function detail($id = 0) {

        $input['where'] = array(
            'status' => 1,
            'pid' => 0
        );

        $this->data['category'] = $this->category_item->get_list($input);

        $this->data['info'] = $this->category_item->get_info($id);

        if ($this->input->post()) {

            $this->form_validation->set_rules('vn_name', 'Tên danh mục', 'required');

            if ($this->form_validation->run()) {


                #Tạo folder upload theo ngày truoc khi upload
                $upload_path = 'uploads/images/productcategory/';

                $upload_data = $this->system_library->upload($upload_path, 'image_link');

                $image_link = '';

                //Xử lý hình ảnh của sản phẩm và sản phẩm kèm theo
                if ($upload_data != NULL && !isset($info->image_link)) {
                    $image_link = $upload_data;
                    $this->system_library->resize_image('crop', $upload_path . $image_link, $upload_path . '842_1024/' . $image_link, 842, 1024);
                    @unlink($upload_path . $image_link);
                } elseif ($upload_data != NULL && $info->image_link) {
                    $image_link = $upload_data;
                    @unlink($upload_path . '842_1024/' . $info->image_link);
                    $this->system_library->resize_image('crop', $upload_path . $image_link, $upload_path . '842_1024/' . $image_link, 842, 1024);
                    @unlink($upload_path . $image_link);
                } else {
                    $image_link = $info->image_link;
                }

                $slug = $this->input->post('vn_slug', true);

                $i = 0;
                $dup = 1;
                while ($dup) {

                    $dup = $this->category_item->check_exists(array('id <>' => $id, 'vn_slug' => $slug . ($i ? '-' . $i : '')));
                    if ($dup)
                        $i++;
                }

                $slug .= $i ? '-' . $i : '';
                $pid = $this->input->post('pid', true);

                $data = array(
                    'pid' => $pid,
                    'vn_name' => $this->input->post('vn_name', true),
                    'vn_slug' => $slug,
                    'vn_keyword' => $this->input->post('vn_keyword', true),
                    'vn_title' => $this->input->post('vn_title', true),
                    'vn_description' => $this->input->post('vn_description', true),
                    'vn_sapo' => $this->input->post('vn_sapo'),
                    'image_link' => $image_link,
                    'status' => $this->input->post('status', true),
                    'created' => now(),
                );

                if (!$id) {
                    if ($this->category_item->create($data)) {
                        $this->session->set_flashdata('message', 'Thêm danh mục thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Thêm danh mục thất bại');
                    }
                } else {
                    if ($this->category_item->update($id, $data)) {
                        $this->session->set_flashdata('message', 'Cập nhật danh mục thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Cập nhật danh mục thất bại');
                    }
                }
                if ($pid) {
                    redirect(base_url('admincp/product_category?id=&vn_name=&pid=' . $pid));
                } else {
                    redirect(base_url() . 'admincp/product_category/index/');
                }
            }
        }


        $this->data['title'] = 'Thêm danh mục';

        $this->data['temp'] = 'product_category/detail';
        $this->load->view('admin/main', $this->data);
    }

    public function config() {

        $action = $this->input->post('key', true); //'del_all';

        $id = $this->input->post('id', true);

        $ids = $this->input->post('ids', true); //array(4, 5, 6);

        if ($ids) {
            $array_id = implode(',', $ids);
            $where_in = 'id in (' . $array_id . ')';
        }

        $msg = '';
        $status = 0;

        switch ($action) {
            case 'del':
                $where['where'] = 'pid = ' . $id;

                $check_catalog = $this->category_item->get_list($where);

                //Check danh mục có tồn tại danh mục con hay k
                if ($check_catalog) {
                    $id_array = array();
                    foreach ($check_catalog as $row) {
                        $id_array[] = $row->id;
                    }
                    $id_object = implode(',', $id_array);

                    $check_product_sub = $this->item->check_exists('cid in (' . $id_object . ')');
                    $input = 'id in(' . $id_object . ')';
                    //Check danh mục con có tồn tại sản phẩm k
                    if ($check_product_sub) {
                        // Xóa toàn bộ sản phẩm của danh mục con đó xong xóa danh mục
                        if ($this->item->update_rule('cid in (' . $id_object . ')', array('status' => 3))) {
                            if ($this->category_item->update_rule($input, array('status' => 3))) {
                                if ($this->category_item->update($id, array('status' => 3))) {
                                    $msg = 'Xóa thành công tất cả sản phẩm của danh mục con, danh mục con, danh mục';
                                    $status = 3;
                                }
                            }
                        }
                    } else {
                        //Xóa danh mục con thành công thì xóa danh mục cha
                        if ($this->category_item->update_rule($input, array('status' => 3))) {
                            if ($this->category_item->update($id, array('status' => 3))) {
                                $msg = 'Xóa thành công danh mục và toàn bộ danh mục con của danh mục đó';
                                $status = 3;
                            }
                        }
                    }
                } else {
                    $check_product = $this->item->check_exists('cid = ' . $id . '');
                    //Check xem danh muc co san pham k
                    if ($check_product) {
                        //Xóa toàn bộ sản phẩm của danh mục đó xong xóa danh mục
                        $input = 'cid = ' . $id;
                        if ($this->item->update_rule($input, array('status' => 3))) {
                            if ($this->category_item->update($id, array('status' => 3))) {
                                $msg = 'Xóa thành công danh mục và sản phẩm của danh mục đó';
                                $status = 3;
                            }
                        }
                    } else {
                        if ($this->category_item->update($id, array('status' => 3))) {
                            $msg = 'Xóa thành công danh mục';
                            $status = 3;
                        }
                    }
                }

                break;

            case 'del_all':

                $where['where'] = 'pid in (' . $array_id . ')';

                $check_catalog_all = $this->category_item->get_list($where);

                if ($check_catalog_all) {

                    $id_array_all = array();
                    foreach ($check_catalog_all as $row) {
                        $id_array_all[] = $row->id;
                    }

                    $id_object_all = implode(',', $id_array_all);
                    $check_product_sub = $this->item->check_exists('cid in (' . $id_object_all . ')');
                    $input = 'id in(' . $id_object_all . ')';

                    //Check danh mục có tồn tại sản phẩm k
                    if ($check_product_sub) {
                        // Xóa toàn bộ sản phẩm của danh mục con đó xong xóa danh mục
                        if ($this->item->update_rule('cid in (' . $id_object_all . ')', array('status' => 3))) {
                            if ($this->category_item->update_rule($input, array('status' => 3))) {
                                if ($this->category_item->update_rule($where_in, array('status' => 3))) {
                                    $msg = 'Xóa toàn bộ các danh mục đã chọn bao gồm các danh mục con và sản phẩm';
                                    $status = 3;
                                }
                            }
                        }
                    } else {
                        //Xóa danh mục con thành công thì xóa danh mục cha
                        if ($this->category_item->update_rule($input, array('status' => 3))) {
                            if ($this->category_item->update_rule($where_in, array('status' => 3))) {
                                $msg = 'Xóa thành công danh mục và toàn bộ danh mục con của danh mục đó';
                                $status = 3;
                            }
                        }
                    }
                } else {
                    $check_product_all = $this->item->check_exists('cid in (' . $array_id . ')');
                    //Check xem danh muc co san pham k
                    if ($check_product_all) {
                        //Xóa toàn bộ sản phẩm của danh mục đó xong xóa danh mục
                        $input = 'cid in (' . $array_id . ')';
                        if ($this->item->update_rule($input, array('status' => 3))) {
                            if ($this->category_item->update_rule($where_in, array('status' => 3))) {
                                $msg = 'Xóa thành công tất danh mục và sản phẩm của tất cả danh mục đó';
                                $status = 3;
                            }
                        }
                    } else {
                        if ($this->category_item->update_rule($where_in, array('status' => 3))) {
                            $msg = 'Xóa thành công tất cả danh mục';
                            $status = 3;
                        }
                    }
                }

                break;
            case 'enable':
                if ($this->category_item->update($id, array('status' => 1))) {
                    $msg = 'Hiển thị danh mục thành công';
                    $status = 1;
                }
                break;
            case 'enable_all':

                if ($this->category_item->update_rule($where_in, array('status' => 1))) {
                    $msg = 'Hiển thị danh mục thành công';
                    $status = 1;
                }

                break;
            case 'disable':

                $where['where'] = 'pid = ' . $id;

                $check_catalog = $this->category_item->get_list($where);

                if ($check_catalog) {
                    $id_array = array();
                    foreach ($check_catalog as $row) {
                        $id_array[] = $row->id;
                    }
                    $id_object = implode(',', $id_array);
                    $check_product_sub = $this->item->check_exists('cid in (' . $id_object . ')');
                    $input = 'id in(' . $id_object . ')';

                    if ($check_product_sub) {

                        if ($this->item->update_rule('cid in (' . $id_object . ')', array('status' => 2))) {
                            if ($this->category_item->update_rule($input, array('status' => 2))) {
                                if ($this->category_item->update($id, array('status' => 2))) {
                                    $msg = 'Ẩn thành công tất cả sản phẩm của danh mục con, danh mục con, danh mục';
                                    $status = 2;
                                }
                            }
                        }
                    } else {

                        if ($this->category_item->update_rule($input, array('status' => 2))) {
                            if ($this->category_item->update($id, array('status' => 2))) {
                                $msg = 'Ẩn thành công danh mục và toàn bộ danh mục con của danh mục đó';
                                $status = 2;
                            }
                        }
                    }
                } else {

                    $check_product = $this->item->check_exists('cid = ' . $id . '');

                    if ($check_product) {

                        $input = 'cid = ' . $id;
                        if ($this->item->update_rule($input, array('status' => 2))) {
                            if ($this->category_item->update($id, array('status' => 2))) {
                                $msg = 'Ẩn thành công danh mục và sản phẩm của danh mục đó';
                                $status = 2;
                            }
                        }
                    } else {
                        if ($this->category_item->update($id, array('status' => 2))) {
                            $msg = 'Ẩn thành công danh mục';
                            $status = 2;
                        }
                    }
                }

                break;

            case 'disable_all':

                $where['where'] = 'pid in (' . $array_id . ')';

                $check_catalog_all = $this->category_item->get_list($where);

                if ($check_catalog_all) {

                    $id_array_all = array();
                    foreach ($check_catalog_all as $row) {
                        $id_array_all[] = $row->id;
                    }

                    $id_object_all = implode(',', $id_array_all);
                    $check_product_sub = $this->item->check_exists('cid in (' . $id_object_all . ')');
                    $input = 'id in(' . $id_object_all . ')';

                    //Check danh mục có tồn tại sản phẩm k
                    if ($check_product_sub) {
                        // Xóa toàn bộ sản phẩm của danh mục con đó xong xóa danh mục
                        if ($this->item->update_rule('cid in (' . $id_object_all . ')', array('status' => 2))) {
                            if ($this->category_item->update_rule($input, array('status' => 2))) {
                                if ($this->category_item->update_rule($where_in, array('status' => 2))) {
                                    $msg = 'Ẩn toàn bộ các danh mục đã chọn bao gồm các danh mục con và sản phẩm';
                                    $status = 2;
                                }
                            }
                        }
                    } else {
                        //Xóa danh mục con thành công thì xóa danh mục cha
                        if ($this->category_item->update_rule($input, array('status' => 2))) {
                            if ($this->category_item->update_rule($where_in, array('status' => 2))) {
                                $msg = 'Ẩn thành công danh mục và toàn bộ danh mục con của danh mục đó';
                                $status = 2;
                            }
                        }
                    }
                } else {

                    $check_product_all = $this->item->check_exists('cid in (' . $array_id . ')');
                    //Check xem danh muc co san pham k
                    if ($check_product_all) {
                        //Xóa toàn bộ sản phẩm của danh mục đó xong xóa danh mục
                        $input = 'cid in (' . $id . ')';
                        if ($this->item->update_rule($input, array('status' => 2))) {
                            if ($this->category_item->update_rule($where_in, array('status' => 2))) {
                                $msg = 'Ẩn thành công tất danh mục và sản phẩm của tất cả danh mục đó';
                                $status = 2;
                            }
                        }
                    } else {
                        if ($this->category_item->update_rule($where_in, array('status' => 2))) {
                            $msg = 'Ẩn thành công tất cả danh mục';
                            $status = 2;
                        }
                    }
                }
                break;
        }
        echo json_encode(array('msg' => $msg, 'status' => $status));
    }

    public function position() {

        $position = $this->input->post('position');

        $id = $this->input->post('id');

        if ($this->input->post()) {
            if ($this->category_item->update($id, array('position' => $position))) {
                $msg = 'Chọn vị trí danh mục thành công';
                echo json_encode(array('msg' => $msg, 'success' => true));
            }
        }
    }

    public function clean_trash() {

        $where['where'] = 'status = 3';
        $check_del = $this->category_item->get_list($where);
        $id_del = array();
        foreach ($check_del as $row) {
            $id_del[] = $row->id;
        }
        $object_id_del = implode(',', $id_del);
        if ($object_id_del) {
            $input['where'] = 'cid in (' . $object_id_del . ')';

            $check_del_product = $this->item->get_list($input);

            if ($check_del_product) {
                if ($this->item->del_rule('cid in (' . $object_id_del . ')')) {
                    foreach ($check_del_product as $item) {
                        @unlink('uploads/images/product/' . $item->image_link);
                        @unlink('uploads/images/product/242_200/' . $item->image_link);
                    }
                    if ($this->category_item->del_rule('status = 3')) {
                        $this->session->set_flashdata('message', 'Dọn rác thành công');
                    }
                }
            } else {
                if ($this->category_item->del_rule('status = 3')) {
                    $this->session->set_flashdata('message', 'Dọn rác thành công');
                }
            }
        } else {
            $this->session->set_flashdata('message', 'Không có gì trong thùng rác');
        }

        redirect(base_url('admincp/product_category'));
    }

}
