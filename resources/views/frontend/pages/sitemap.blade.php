<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://test.cancard.com/</loc>
    </url>
    <url>
        <loc>https://test.cancard.com/about-us</loc>
    </url>
    <url>
        <loc>https://test.cancard.com/store</loc>
    </url>
    <url>
        <loc>https://test.cancard.com/contact-us</loc>
    </url>
    <url>
        <loc>https://test.cancard.com/service-support-maintenance</loc>
    </url>
    @foreach($xmlcategories as $category)
        <url>
            <loc>https://test.cancard.com/category/{{ $category->slug }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($category->updated_at)) }}</lastmod>
        </url>
    @endforeach
    @foreach($xmlmainappresults as $xmlapplication)
        <url>
            <loc>https://test.cancard.com/application/{{ $xmlapplication->slug }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($xmlapplication->updated_at)) }}</lastmod>
        </url>
    @endforeach
    @foreach($xmlproducts as $xmlproduct)
        <url>
            <loc>https://test.cancard.com/product/{{ $xmlproduct->slug }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($xmlproduct->updated_at)) }}</lastmod>
        </url>
    @endforeach
</urlset>