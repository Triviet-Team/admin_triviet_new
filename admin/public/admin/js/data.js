
// $('.order-table').DataTable({
//   "processing": true,
//   "responsive": true,
//   "deferRender": true,
  
//   "ajax": {
//     "url": "http://5bb8ef65b6ed2c0014d47508.mockapi.io/Ok/order",
//     "dataSrc": ""
//   },
//   "columns": [
//     { 
//       "data": "id",
//       "sortable": false,
//       "render": function(data, type, row) {
//         return (
//           `${row.id}`
//         );
//       },
//     },
    
//     { 
//       "data": "user",
//       "render": function(data, type, row) {
//         return (
//           `${row.user}`
//         );
//       },
//     },
//     { 
//       "data": "quantity",
//       "render": function(data, type, row) {
//         return (
//           `${row.quantity}`
//         );
//       },
//     },
//     { 
//       "data": "price",
//       "render": function(data, type, row) {
//         return (
//           `${row.price}`
//         );
//       },
//     },
//     { 
//       "data": "status",
//       "sortable": false,
//       "render": function(data, type, row) {
//         return (
//           `
//             <div class="status">
//               <h5 class="btn-warning">Mới nhận</h5>
//               <h5 class="btn-success d-none">Đã xử lý</h5>
//               <h5 class="btn-danger d-none">Hủy bỏ</h5>
//             </div>
//           `
//         )
//       },
//     },
//     { 
//       "data": "date",
//       "render": function(data, type, row) {
//         return (
//           `${row.date}`
//         );
//       },
//     },
//     { 
//       "data": "action",
//       "sortable": false,
//       "render": function(data, type, row) {
//         return (
//           `
//           <div class="action-zone">
//             <a class="action btn-light" data-toggle="modal" data-target=".view-order-1">
//               <span>Xem chi tiết</span>
//               <i class="mdi mdi-eye-plus"></i>
//             </a>
//           </div>
//           `
//         );
//       },
//     },
//   ],

//   "language": {
//     "processing": "Đang tải",
//     "lengthMenu": "Hiển thị _MENU_ mục",
//     "emptyTable":     "Không có dữ liệu nào trong bảng",
//     "loadingRecords": "Đang tải...",
//     "zeroRecords": "Không có mục nào được tìm thấy",
//     "info": "Hiển thị _START_ đến _END_ trong _TOTAL_ mục",
//     "infoEmpty": "Không có mục nào có sẵn",
//     "infoFiltered": "(Lọc từ _MAX_ mục)",
//     "search": "Tìm kiếm:",
//     "paginate": {
//         "first":      "Đầu",
//         "last":       "Cuối",
//         "next":       "Sau",
//         "previous":   "Trước"
//     },
//   },
//   "order": [[ 6, "desc" ]],
//   "pagingType": "full_numbers",
//   "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tất cả"]],
// });


// const productTable = $('.product-table').DataTable({
//   "processing": true,
//   "responsive": true,
//   "deferRender": true,
  
//   "ajax": {
//     "url": "http://5bb8ef65b6ed2c0014d47508.mockapi.io/Ok/order",
//     "dataSrc": ""
//   },
//   "columns": [
//     { 
//       "data": "checkbox",
//       "sortable": false,
//       "render": function(data, type, row) {
//         return (
//           `
//           <label class="check-box">
//             <input type="checkbox" />
//             <span class="checkmark"></span>
//           </label>
//           `
//         );
//       },
//     },
//     { 
//       "data": "id",
//       "render": function(data, type, row) {
//         return (
//           `${row.id}`
//         );
//       },
//     },
//     { 
//       "data": "category",
//       "sortable": false,
//       "render": function(data, type, row) {
//         return (
//           `${row.category}`
//         );
//       },
//     },
//     { 
//       "data": "product",
//       "sortable": false,
//       "render": function(data, type, row) {
//         return (
//           `
//             <div class="text-left" style="min-width: 250px">
//               <a data-fancybox="gallery" href=${row.image}>
//                 <img src=${row.image} />
//               </a> 
//               <h5>${row.name}</h5>
//             </div>
//           `
//         );
//       },
//     },
//     { 
//       "data": "price",
//       "render": function(data, type, row) {
//         return (
//           `${row.price}`
//         );
//       },
//     },
//     { 
//       "data": "status",
//       "sortable": false,
//       "render": function(data, type, row) {
//         return (
//           `
//             <div class="status">
//               <h5 class="btn-success">Hiển thị</h5>
//               <h5 class="btn-warning d-none">Ẩn</h5>
//               <h5 class="btn-danger d-none">Xóa</h5>
//             </div>
//           `
//         )
//       },
//     },
//     { 
//       "data": "date",
//       "render": function(data, type, row) {
//         return (
//           `${row.date}`
//         );
//       },
//     },
//     { 
//       "data": "action",
//       "sortable": false,
//       "render": function(data, type, row) {
//         return (
//           `
//           <div class="action-zone">
//             <a class="action btn-light" href="them-san-pham.html">
//               <span>Chỉnh sửa</span>
//               <i class="mdi mdi-pencil"></i>
//             </a>
//             <a class="action btn-light active-single">
//               <span>Hiển thị</span>
//               <i class="mdi mdi-eye-outline"></i>
//             </a>
//             <a class="action btn-light private-single">
//               <span>Ẩn</span>
//               <i class="mdi mdi-crosshairs-gps"></i>
//             </a>
//             <a class="action btn-light delete-single">
//               <span>Xóa</span>
//               <i class="mdi mdi-trash-can-outline"></i>
//             </a>
//           </div>
//           `
//         );
//       },
//     },
//   ],

//   "language": {
//     "processing": "Đang tải",
//     "lengthMenu": "Hiển thị _MENU_ mục",
//     "emptyTable":     "Không có dữ liệu nào trong bảng",
//     "loadingRecords": "Đang tải...",
//     "zeroRecords": "Không có mục nào được tìm thấy",
//     "info": "Hiển thị _START_ đến _END_ trong _TOTAL_ mục",
//     "infoEmpty": "Không có mục nào có sẵn",
//     "infoFiltered": "(Lọc từ _MAX_ mục)",
//     "search": "Tìm kiếm:",
//     "paginate": {
//         "first":      "Đầu",
//         "last":       "Cuối",
//         "next":       "Sau",
//         "previous":   "Trước"
//     },
//   },
//   "order": [[ 1, "desc" ]],
//   "pagingType": "full_numbers",
//   "lengthMenu": [[3, 25, 50, -1], [10, 25, 50, "Tất cả"]],
// });



$(document).ready(() => {

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });


  $('#go-trash').click(() => {
    Swal({
      title: 'Bạn chắc chắn chứ?',
      text: "Thao tác này sẽ được thay đổi trong database!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Tôi đồng ý, Dọn!',
      cancelButtonText: 'Hủy bỏ'
    }).then((result) => {
      if (result.value) {
        Swal(
          'Xóa thành công!',
          'Bạn đã dọn rác thành công.',
          'success'
        ).then(function(res) {
          if (res) {
            // cái cần xóa
          }
        });
      }
    })
  });

  $.fn.datepicker.language['vn'] = {
    days: ['Chủ nhật', 'Thứ Hai', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
    daysShort: ['CN', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy'],
    daysMin: ['CN', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy'],
    months: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6', 'Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
    monthsShort: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6', 'Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
    today: 'Hôm nay',
    clear: 'Xóa',
    dateFormat: 'dd/mm/yyyy',
    timeFormat: 'hh:ii aa',
    firstDay: 0
  };

  var start = new Date(),
    prevDay,
    startHours = 0;

  // 09:00 AM
  start.setHours(0);
  start.setMinutes(0);

  $('#date-time').datepicker({
      timepicker: true,
      language: 'vn',
      startDate: start,
      minHours: startHours,
      maxHours: 24,
      onSelect: function (fd, d, picker) {
          if (!d) return;
          var day = d.getDay();

          if (prevDay != undefined && prevDay == day) return;
          prevDay = day;

          picker.update({
              minHours: 0,
              maxHours: 24
          })
      }
  })
})
