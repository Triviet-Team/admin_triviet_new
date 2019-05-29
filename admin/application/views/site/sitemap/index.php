<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
    <loc><?= base_url() ?></loc>
    <priority>1.00</priority>
    </url>
    <?php
        $xhtmlCate = '';
        $xhtmlProduct = '';
        foreach ($obj_product as $row) {
            $xhtmlCate .= '<url>
                                <loc>'. base_url($row->vn_slug . '.html').'</loc>
                                <priority>0.80</priority>
                            </url>';
            if ($row->list_product) {
                foreach ($row->list_product as $row1) {
                    $xhtmlProduct .= '<url>
                                        <loc>'. base_url($row1->vn_slug . '-p' . $row1->id . '.html').'</loc>
                                        <priority>0.64</priority>
                                    </url>';
                }
            }
        }
        
        echo $xhtmlCate;
        echo $xhtmlProduct;
        
    ?>

    <?php
        foreach ($articles as $row) {
            ?>
            <url>
                <loc><?= base_url($row->vn_slug  . '-a' . $row->id .  '.html') ?></loc>
                <lastmod><?= date('c') ?></lastmod>
                <changefreq>daily</changefreq>
                <priority>0.5</priority>
            </url>
    <?php } ?>
</urlset>