<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate XML sitemap for search engines
     */
    public function index(): Response
    {
        $products = Product::where('is_active', true)->get(['slug', 'updated_at']);
        $categories = Category::where('is_active', true)->get(['slug', 'updated_at']);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        // Static routes
        $static = [
            '/' => Carbon::now()->subDays(1),
            '/katalog' => Carbon::now(),
            '/faq' => Carbon::now()->subDays(7),
            '/kontak' => Carbon::now()->subDays(14),
        ];
        foreach ($static as $loc => $lastmod) {
            $xml .= $this->url($loc, $lastmod);
        }

        // Category pages
        foreach ($categories as $cat) {
            $xml .= $this->url('/katalog/'.$cat->slug, $cat->updated_at);
        }

        // Product pages
        foreach ($products as $prod) {
            $xml .= $this->url('/produk/'.$prod->slug, $prod->updated_at);
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    protected function url(string $loc, Carbon $lastmod): string
    {
        return sprintf(
            "  <url>\n    <loc>%s</loc>\n    <lastmod>%s</lastmod>\n    <changefreq>weekly</changefreq>\n    <priority>%s</priority>\n  </url>\n",
            url($loc),
            $lastmod->toDateString(),
            $loc === '/' ? '1.0' : '0.8'
        );
    }

    /**
     * robots.txt with dynamic Sitemap URL
     */
    public function robots(): Response
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin\n";
        $content .= "Disallow: /admin/*\n";
        $content .= "Disallow: /login\n";
        $content .= "Disallow: /register\n";
        $content .= "Disallow: /password-reset\n\n";
        $content .= 'Sitemap: '.url('/sitemap.xml')."\n";

        return response($content, 200, ['Content-Type' => 'text/plain']);
    }
}
