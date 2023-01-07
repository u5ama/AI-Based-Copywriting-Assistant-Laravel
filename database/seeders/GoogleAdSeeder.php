<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GoogleAdSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $ToolArr = [
      'title' => 'Google Ad',
      'short_description' => 'Create Google Ad with exact requirement and layouts',
      'uri' => 'google',
      'context' => 'Use Input text and Tone to write a creative Google ad as Output.\n-----------\nName: Goli\nInput: Each bottle of Goli contains 60 delicious vegan, non-GMO, gluten-free & gelatine-free Apple Cider gummies. Our formula will make Apple Cider Vinegar gummies accessible to anyone and everyone. Better digestion, more energy, clearer skin, detox, immunity: Relieve digestion issues, experience more energy, watch your skin clear up and feel as your body detoxes with Goli Gummies. Enjoy all of the benefits of Apple Cider Vinegar without the downside of drinking it. Goli is an excellent and easy way to incorporate Apple Cider Vinegar into your daily routine.\nTone: Professional\n-----------\nOutput:\nGoli Gummies are Gluten-Free, Vegan, Non-GMO & Gelatin Free - 100% Natural & Plant-Based. Try Goli risk-free & take advantage of our 30-Day Money-Back Guarantee! Shop Now! Infused With Superfoods. Helps Reduce Weight.\n-----------\nName: BlendJet\nInput: We created the BlendJet portable blender so you can make anything you want, anywhere in the world — from a mountaintop to your kitchen countertop. It’s easy and convenient to use at home, at work, outdoors, at the gym, in the car, at the beach, on vacation or wherever the day takes you.\nTone: Professional\n-----------\nOutput:\nWith BlendJet, enjoy Big Blender Power on the Go. Perfectly Blended Smoothies Anywhere. Get Yours Now! Original Portable Blender. Durable & Built To Last. Portable Yet Powerful. Free 2-Day Shipping! \n-----------\nName: Magic Spoon\nInput: Magic Spoon cereal is high-protein, low-sugar, keto-friendly, and gluten-free. Available in Cocoa, Frosted, Fruity, Blueberry, Peanut Butter, and Cinnamon.\nTone: Friendly\n-----------\nOutput:\nMagic Spoon, healthy Cereal That Tastes Too Good to be True. High Protein, Low Carb, Sweet & Delicious. Have Your Cereal and Eat It Too. Great Taste with Grown-Up Ingredients. Nothing Artificial. 5-Star Reviewed On Yotpo. Low Sugar. Gluten Free. 100% Money Back Guarantee.\n-----------\nName: AllBirds\nInput: Take stormy weather in stride with AllBirds running shoes that use natural materials to give you extra grip, plus a mid cut knit sock collar to keep your feet warm and dry.\nTone: Professional\n-----------\nOutput:\nthe world\'s most comfortable shoes, flats, and clothing made with natural materials like merino wool and eucalyptus. FREE shipping & returns.\n-----------\nName: Away Bags\nInput: Dream up your future travels with our second collection of Away Bags by Serena Williams. Our Large checked suitcase is built to last, with a durable polycarbonate hard shell and 360° spinner wheels that ensure a smooth ride. Plus, its interior compression system and hidden laundry bag make packing that much easier.\nTone: Professional\n-----------\nOutput:\nInspired by thousands of real travelers. Free shipping & returns. Thoughtfully designed for the way you actually travel. 100 Day Return Policy. Polycarbonate Shell. TSA-Approved Combo Lock. Lightweight.\n-----------\nName: Birchbox\nInput: As a Birchbox subscriber, you’ll receive a monthly box (it’s reusable and recyclable) filled with five expert-selected premium samples and easy-to-follow insider tips. If you fall in love with a sample, we sell the full size version. Looking for something specific? It’s probably in our shop. Curious about Clean Beauty? We have a curated discovery kit. We’re here to make this easy. We’re here to make this fun.\nTone: Professional\n-----------\nOutput:\nGet Your Personalized Mix Of 5 Hair, Makeup, Skincare & Fragrance Samples. We\'ve Upgraded Your Beauty Box Experience. Sign Up Today To Get Started. 4+ Million Reviews. Exclusive Kits & Samplers. Find Products That Work. Customize Your Box.\n-----------\nName: Casper\nInput: Get the sleep you\'ve always dreamed of. Casper\'s award-winning mattresses, sheets & more are quality-crafted and ethically built in the USA. Free shipping and returns.\nTone: Professional\n-----------\nOutput:\nShop Casper\'s best memory foam and hybrid mattresses for side, back, and stomach sleepers online. Find the perfect size and get free shipping and returns.\n-----------\nName:{{$brand_name}}}\nInput: {{$product_description}}\n keywords: {{$key_words}} \nTone: Professional\n-----------\nOutput:\n',
      'icon_path' => '/assets/admin/images/newTemplate/google-symbol.png',
      'color_code' => '#0F9D58',
      'icon_path_inverse' => '<i class="fab fa-google" style="color: #FF8227;"></i>',
      'category' => 'product',
      'temperature' => 0,
      'max_tokens' => 0,
      'top_p' => 0,
      'frequency_penalty' => 0,
      'presence_penalty' => 0,
      'stop' => '---',
      'status' => 'active',
    ];

    $ToolItemsArr = [
      [
        'input_title'               => 'Brand Name',
        'input_info_text'           => '',
        'input_info_placeholder'    => 'e.g. Typeskip',
        'slug'                      => 'brand-name',
        'required'                  => 1,
        'input_limit'               => 80,
        'input_type'                => 'input',
        'status'                    => 'active',
        'key'                       => 'brand_name'
      ],
      [
        'input_title'               => 'Company or Product Description',
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
        'input_title'               => 'Add Keywords',
        'input_info_text'           => '',
        'input_info_placeholder'    => 'Add Keyword',
        'slug'                      => 'outputs',
        'required'                  => 1,
        'input_limit'               => 10,
        'input_type'                => 'multi-select',
        'status'                    => 'active',
        'input_options'             => '',
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
