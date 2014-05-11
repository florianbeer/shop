{{ '<?xml version="1.0" encoding="UTF-8"?>'."\n" }}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($categories as $category)
<url>
    <loc>{{URL::route('categories.show', $category->id)}}</loc>
    <changefreq>weekly</changefreq>
    </url>
@endforeach

@foreach($products as $product)
<url>
    <loc>{{URL::route('products.show', $product->id)}}</loc>
    <lastmod>{{date('Y-m-d', strtotime($product->updated_at))}}</lastmod>
</url>
@endforeach
</urlset>