<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MarketingAnglesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ToolArr = [
            'title' => 'Market Angles',
            'short_description' => 'Write different marketing angles using Product Description.',
            'uri' => 'marketing-angles',
            'context' => 'Write different marketing angles using Product Description\n---\nName: Pushpress\n---\nProduct Description: Pushpress allows your gym to schedule and manage Gym Classes online.\n---\nMarketing Angles:\n- Save time managing your gym with our easy, intuitive software\n- You can finally focus on what you are passionate about and still make money \n- We will take the stress out of running a business. Let us worry about everything\n---\nName: TypeSkip\n---\nProduct Description:  TypeSkip sells hand poured candles with amazing fragrances that are made in the UK.\n---\nMarketing Angles:\n- TypeSkip is an environmentally friendly company\n- Get your holiday shopping done early with TypeSkips amazing variety of candles that are perfect for all occasions\n- Our fragrances will transport you to a place near and dear to your heart \n- Be the hostess with the mostest by giving the gift of a hand poured candle\n---\nName: Zameen\n---\nProduct Description: Zameen is an online real estate platform where buyers can list land and houses and sellers can make offers to buy them\n---\nMarketing Angles:\n- Zameen is the best destination for those looking to buy or sell land and housing. \n- Find your dream home on our platform in just a few clicks \n- Sell your property without having to spend time showing it to prospective buyers\n---\nName: QuickBands\n---\nProduct Description: Quickbands are resistance bands that you can attach to any door which helps you workout at home and on the go\n---\nMarketing Angles:\n- You can do workouts in the comfort of your own home\n- Stay healthy and fit while watching Netflix or doing work around the house\n- No need to go to an expensive gym with slick looking equipment. Quickbands are easy on your wallet\n---\nName: QuickBands\n---\nProduct Description: Quickbands are resistance bands that you can attach to any door which helps you workout at home and on the go\n---\nMarketing Angles:\n- Allbirds are not like any other shoe you will wear. They are made from wool and wont unravel or get ruined with time.\n- These shoes will be your new favorite because the wool is so comfortable, you will never want to take these off again!\n- Taking care of a sweater is enough, why do you have to worry about socks? With our knit shoes that never hurt your feet and feel amazing on them, they will be your new go-to for comfort no matter what the day throws at you.\n---\nName: Goli\n---\nProduct Description: Goli gummies are apple cider vinegar gummies. Helps improve digestion, become more energetic, and get clearer skin.\n---\nMarketing Angles:\n- Eat Goli gummies to improve digestion and skin health\n- Eat one of these before a big test or race for mental clarity\n- Improve your immune system with these helpful gummies\n---\nName: BlendJet\n---\nProduct Description: We created the BlendJet portable blender so you can make anything you want, anywhere in the world — from a mountaintop to your kitchen countertop. It’s easy and convenient to use at home, at work, outdoors, at the gym, in the car, at the beach, on vacation or wherever the day takes you.\n---\nMarketing Angles:\n- Blendjet is so easy to use, you donot need a recipe\n- Carry your favorite protein shake with you in the blender. Blendjet is small and light enough to take anywhere! \n- Need a new smoothie recipe that tastes great? No worries, we got you covered! Check out our recipes section for awesome ideas on what to make today.\n- Make everything from smoothies to salad dressings right in the palm of your hand!\n---\nName: Eyeology Eye Massager\n---\nProduct Description: The Eyeology Eye Massager uses safe air compression technology and adopts kneading, trigger point therapy and rhythmic percussion massaging to give you the gentle touch you need to battle against headaches, eye strain, sleeping problems, stress and more.\n---\nMarketing Angles:\n- Eyeology is the most relaxing way to de-stress\n- Use it for headaches, eye strain, sleeping problems, stress, and more\n- The Eyeology Eye Massager is perfect for anyone who needs a quick pick me up\n---\nName: {{$brand_name}}\n---\nProduct Description: {{$product_description}}\n---\nMarketing Angles:\n',
            'icon_path' => '/assets/admin/images/newTemplate/marketing-angles.png',
            'color_code' => '#0F9D58',
            'icon_path_inverse' => '<i class="fas fa-poll-h" style="color: #FE5C5A;"></i>',
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
