<?php

namespace App\Controllers;

use Core\Controller;

class BlogController extends Controller
{
    public function translations($blogId, $languageId)
    {
        $data = [
            'blog_id' => $blogId,
            'language_id' => $languageId,
            'title' => 'Blog Başlığı',
            'content' => 'Blog İçeriği',
            'language' => $languageId === 'tr' ? 'Türkçe' : 'English'
        ];

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 12px;
                    text-align: left;
                }
                th {
                    background-color: #f5f5f5;
                }
                tr:hover {
                    background-color: #f9f9f9;
                }
            </style>
        </head>
        <body>
            <table>
                <tr>
                    <th>Alan</th>
                    <th>Değer</th>
                </tr>
                <tr>
                    <td>Blog ID</td>
                    <td>' . htmlspecialchars($data['blog_id']) . '</td>
                </tr>
                <tr>
                    <td>Dil</td>
                    <td>' . htmlspecialchars($data['language']) . '</td>
                </tr>
                <tr>
                    <td>Başlık</td>
                    <td>' . htmlspecialchars($data['title']) . '</td>
                </tr>
                <tr>
                    <td>İçerik</td>
                    <td>' . htmlspecialchars($data['content']) . '</td>
                </tr>
            </table>
        </body>
        </html>';

        return $html;
    }

    public function show($id)
    {
        $data = [
            'id' => $id,
            'title' => 'Blog Başlığı',
            'content' => 'Blog İçeriği'
        ];

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                .blog-post {
                    max-width: 800px;
                    margin: 20px auto;
                    padding: 20px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                }
                .blog-title {
                    color: #333;
                    margin-bottom: 15px;
                }
                .blog-content {
                    line-height: 1.6;
                    color: #666;
                }
                .blog-id {
                    color: #999;
                    font-size: 0.9em;
                    margin-bottom: 10px;
                }
            </style>
        </head>
        <body>
            <div class="blog-post">
                <div class="blog-id">Blog ID: ' . htmlspecialchars($id) . '</div>
                <h1 class="blog-title">' . htmlspecialchars($data['title']) . '</h1>
                <div class="blog-content">' . htmlspecialchars($data['content']) . '</div>
            </div>
        </body>
        </html>';

        return $html;
    }
} 