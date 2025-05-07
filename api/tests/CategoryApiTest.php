<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Category;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class CategoryApiTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    public function testGetCategories()
    {
        $client = static::createClient();

        // Gửi request GET /api/categories
        $response = $client->request('GET', '/api/categories');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }

    public function testCreateCategory()
    {
        $client = static::createClient();

        $response = $client->request('POST', '/api/categories', [
            'json' => [
                'name' => 'Electronics',
                'description' => 'Category for electronic products.'
            ],
        ]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains([
            'name' => 'Electronics',
            'description' => 'Category for electronic products.',
        ]);
    }


    public function testCreateMultipleCategories()
    {
        $client = static::createClient();

        $categories = [
            ['name' => 'Electronics', 'description' => 'Category for electronic products.'],
            ['name' => 'Books', 'description' => 'Category for books and magazines.'],
            ['name' => 'Clothing', 'description' => 'Category for clothes and accessories.'],
        ];

        foreach ($categories as $category) {
            $response = $client->request('POST', '/api/categories', [
                'json' => $category,
            ]);

            $this->assertResponseStatusCodeSame(201);
            $this->assertJsonContains([
                'name' => $category['name'],
                'description' => $category['description'],
            ]);
        }
    }


    public function testUpdateCategory()
    {
        $client = static::createClient();

        // Tạo sẵn category trước
        $em = self::getContainer()->get('doctrine')->getManager();
        $category = new Category();
        $category->setName('Old Name')->setDescription('Old Description');
        $em->persist($category);
        $em->flush();

        $client->request('PUT', '/api/categories/' . $category->getId(), [
            'json' => ['name' => 'New Name', 'description' => 'New Description'],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['name' => 'New Name', 'description' => 'New Description']);
    }

    public function testDeleteCategory()
    {
        $client = static::createClient();

        // Tạo sẵn category trước
        $em = self::getContainer()->get('doctrine')->getManager();
        $category = new Category();
        $category->setName('To Delete');
        $em->persist($category);
        $em->flush();

        $client->request('DELETE', '/api/categories/' . $category->getId());
        $this->assertResponseStatusCodeSame(204);
    }
}
