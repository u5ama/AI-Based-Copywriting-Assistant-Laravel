<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GreateHeadLines extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ToolArr = [
            'title' => 'Great Headlines',
            'short_description' => 'Create high quality headlines in seconds.',
            'uri' => 'great-headlines',
            'context' => 'Write a headline using the product description\n---\nName: TypeSkip\n---\nProduct description: Software that uses AI to write facebook ads, product description, and more\n---\nWho is it for: Entrepreneurs\n---\nHeadline: \n- Boost your sales with AI-powered ads and copy\n- The only software that will write ads for you\n- Automate your content creation with one tool\n---\nName: Pushpress\n---\nProduct description: Pushpress is resistance bands that help you work out at home.\n---\nWho is it for: Overweight People\n---\nHeadline: \n- Lose fat and gain strength without going to the gym.\n- See how easy it is to get fit in the comfort of your own home\n- Get fit anywhere\n---\nName: Zameen\n---\nProduct description: Zameen is an online real estate platform in Pakistan where buyers can list land and houses and sellers can make offers to buy them\n---\nWho is it for: Casual\n---\nHeadline: \n- Buy and sell land\n- Get the best deal on buying a house\n- The first online marketplace for real estate in Pakistan\n- We make it easy to buy or sell any property in Pakistan\n---\nName: AllBirds\n---\nProduct description: Zameen is an online real estate platform where buyers can list land and houses and sellers can make offers to buy them\n---\nWho is it for: Real Estate\n---\nHeadline: \n- The shoe that will change the way you feel about shoes\n- Super comfortable knit shoes made from wool\n- Shoes so comfortable, you can wear them all day.\n---\nName: Goli\n---\nProduct description: Goli gummies are apple cider vinegar gummies. Helps improve digestion, become more energetic, and get clearer skin.\n---\nWho is it for: Casual\n---\nHeadline: \n- Get Goli to help with digestion, skin and energy\n- Goli gummies are Apple Cider Vinegar gummies\n- Feel better today by getting your Goli shipment.\n- Try our delicious apple cider vinegar candies for free!\n---\nName: Blendjet\n---\nProduct description:  We created the BlendJet portable blender so you can make anything you want, anywhere in the world — from a mountaintop to your kitchen countertop. It’s easy and convenient to use at home, at work, outdoors, at the gym, in the car, at the beach, on vacation or wherever the day takes you.\n---\nWho is it for: Casual\n---\nHeadline: \n- Blend in seconds, wherever you go\n- Create your own smoothies and shakes on the go\n- Portable blender for travel, home & car\n---\nName: TypeSkip\n---\nProduct description: Hand poured candles with amazing fragrances that are made in the UK.\n---\nWho is it for: Casual\n---\nHeadline:\n- Hand poured candles with premium fragrances\n- Premium and beautiful scented candles\n- Great gift ideas for every occasion\n---\nName:{{$brand_name}}\n---\nProduct description:{{$product_description}}\n---\nWho is it for:{{$key_words}}\n---\nHeadline:\n',
            'icon_path' => '/assets/admin/images/newTemplate/headline-generator.svg',
            'color_code' => '#0F9D58',
            'icon_path_inverse' => '<i class="far fa-newspaper" style="color: #FE5C5A;"></i>',
            'category' => 'product',
            'temperature' => 0.7,
            'max_tokens' => 170,
            'top_p' => 1,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
            'stop' => '---',
            'status' => 'active',
        ];

        $ToolItemsArr = [
            [
                'input_title'               => 'Name',
                'input_info_text'           => '',
                'input_info_placeholder'    => 'e.g. TypeSkip',
                'slug'                      => 'brand-name',
                'required'                  => 1,
                'input_limit'               => 80,
                'input_type'                => 'input',
                'status'                    => 'active',
                'key'                       => 'brand_name'
            ],
            [
                'input_title'               => 'Product Description',
                'input_info_text'           => '',
                'input_info_placeholder'    => 'Write high quality content, product descriptions, and more using just a few keywords or one-liners',
                'slug'                      => 'company-or-product-description',
                'required'                  => 1,
                'input_limit'               => 400,
                'input_type'                => 'textarea',
                'status'                    => 'active',
                'key'                       => 'product_description'
            ],
            [
                'input_title'               => 'Who is it for',
                'input_info_text'           => '',
                'input_info_placeholder'    => 'e.g. Casual',
                'slug'                      => 'outputs',
                'required'                  => 1,
                'input_limit'               => 80,
                'input_type'                => 'input',
                'status'                    => 'active',
                'key'                       => 'key_words'
            ]
        ];

        $ContentTool = \App\Models\ContentTool::whereUri($ToolArr['uri'])->first();

        if ($ContentTool) {
            \App\Models\ContentTool::where('id', $ContentTool->id)->update($ToolArr);
            foreach ($ToolItemsArr as $ToolItem) {
                $ContentToolItem = \App\Models\ContentToolItem::whereSlug($ToolItem['slug'])->where('content_tool_id', $ContentTool->id)->first();
                if ($ContentToolItem) {
                    \App\Models\ContentToolItem::where('id', $ContentToolItem->id)->update($ToolItem);
                } else {
                    $ToolItem['content_tool_id'] = $ContentTool->id;
                    \App\Models\ContentToolItem::factory(1)->create($ToolItem);
                }
            }
        } else {
            $ContentTool = \App\Models\ContentTool::factory(1)->create($ToolArr);
            foreach ($ToolItemsArr as $ToolItem) {
                $ToolItem['content_tool_id'] = $ContentTool[0]->id;
                \App\Models\ContentToolItem::factory(1)->create($ToolItem);
            }
        }
    }
}
