<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AIDAPrincipleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ToolArr = [
            'title' => 'AIDA Principle',
            'short_description' => 'Write Attention, Interest, Desire, Action using product description.',
            'uri' => 'aida-principle',
            'context' => 'Write Attention, Interest, Desire, Action using product description.\n---\nName: Pushpress\n---\nProduct Description: Pushpress allows your gym to schedule and manage Gym Classes online.\n---\nTone of Voice: Professional\n---\nAttention: Gym owners, are you tired of managing your gyms schedule?\n\nInterest: Pushpress is the perfect solution for any fitness facility. Our software allows you to manage classes online and make sure that every class has a qualified instructor. You can also track attendance and generate reports with our easy-to-use dashboard.\n\nDesire: With Pushpress, you will never have to worry about scheduling again! We offer unlimited access to our platform so all of your staff members will be able to use it from anywhere at anytime. Plus, we are always adding new features like mobile notifications so you can stay on top of everything even when you are not in the office!\n\nAction: Sign up for a free trial today by clicking this ad!\n---\nName: Zameen\n---\nProduct Description: Zameen is an online real estate platform where buyers can list land and houses and sellers can make offers to buy them\n---\nTone of Voice: Professional\n---\nAttention: Looking for a house or land?\n\nInterest: Zameen is the best place to find your next home. We have listings of houses and plots all over Pakistan, so you can find what you’re looking for in no time. Whether it’s a plot or a house, we have something that will suit your needs. You can even search by location!\n\nDesire: Find your dream property with Zameen today! Our site is easy to use and has everything you need on one page – just enter your requirements and let our system do the rest. It couldnot be easier than this!\n\nAction: Visit zameen.com now to start browsing through our extensive selection of properties in Pakistan!\n---\nName: Goli\n---\nProduct Description: Goli gummies are apple cider vinegar gummies. Helps improve digestion, become more energetic, and get clearer skin.\n---\nTone of Voice: Professional\n---\nAttention: Do you want to feel more energetic? Have clearer skin? Improve your digestion?\n\nInterest: Goli is a natural, healthy way to do all of the above. Our apple cider vinegar gummies are made with organic ingredients and contain no artificial flavors or colors. They’re gluten-free, vegan, and have zero sugar added. And they taste great!\n\nDesire: We know that many people donot like taking supplements because they are not tasty. With our delicious gummies, you can get the benefits of apple cider vinegar without any fuss at all! Plus, we offer free shipping on orders over $50 in the US so its never been easier to try them out for yourself!\n\nAction: Order your first batch of Goli today by clicking this link!\n---\nName: Blendjet\n---\nProduct Description: We created the BlendJet portable blender so you can make anything you want, anywhere in the world — from a mountaintop to your kitchen countertop. It’s easy and convenient to use at home, at work, outdoors, at the gym, in the car, at the beach, on vacation or wherever the day takes you.\n---\nTone of Voice: Professional\n---\nAttention: Blendjet is the worlds first portable blender.\n\nInterest: With a BlendJet, you can make anything you want, anywhere in the world — from a mountaintop to your kitchen countertop. It’s easy and convenient to use at home, at work, outdoors, at the gym, in the car or wherever life takes you. The BlendJet is perfect for any lifestyle and offers an unparalleled level of convenience and versatility that no other blender on the market can match.\n\nDesire: Make healthy smoothies anytime with just one touch! Get creative with your favorite ingredients like kale or spinach for extra vitamins and minerals—or add some protein powder for a post-workout shake! You can even blend up ice cream when it’s hot outside without having to wait until you get back home. And donot forget about all those delicious frozen drinks like margaritas or daiquiris that are perfect during summertime picnics by the poolside! No matter what drink you are craving right now—you will find it easier than ever before with our portable blender!\n\nAction: Click this link to order your own personal Blendjet today!\n---\nName: {{$brand_name}}\n---\nProduct Description: {{$product_description}}\n---\nTone of Voice: {{$key_words}}\n---\n',
            'icon_path' => '/assets/admin/images/newTemplate/aida-principal.png',
            'color_code' => '#0F9D58',
            'icon_path_inverse' => '<i class="fas fa-ad" style="color: #FE5C5A;"></i>',
            'category' => 'product',
            'temperature' => 0.7,
            'max_tokens' => 200,
            'top_p' => 1,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.05,
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
                'input_title'               => 'Tone of Voice',
                'input_info_text'           => '',
                'input_info_placeholder'    => 'professional',
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
