<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacebookAdSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $ToolArr = [
      'title' => 'Facebook Ad',
      'short_description' => 'A limitless supply of original Facebook Ad Copy',
      'uri' => 'facebook',
      'context' => 'Write a creative Facebook ad using the Product Description:\n---\nName: Goli\nProduct Description: Goli gummies are apple cider vinegar gummies. Helps improve digestion, become more energetic, and get clearer skin.\n---\nKeywords: vegan, gluten-free, gelatine-free\n---\nFacebook Ad:\nGoli gummies are a delicious, vegan, gluten-free and gelatine-free way to increase your intake of apple cider vinegar. Our formula will make Apple Cider Vinegar gummies accessible to anyone and everyone. Relieve digestion issues, experience more energy, watch your skin clear up and feel as your body detoxes with Goli Gummies. Enjoy all of the benefits of Apple Cider Vinegar without the downside of drinking it. Goli is an excellent and easy way to incorporate Apple Cider Vinegar into your daily routine.\n---\nName: Blendjet\nProduct Description: We created the BlendJet portable blender so you can make anything you want, anywhere in the world — from a mountaintop to your kitchen countertop. It’s easy and convenient to use at home, at work, outdoors, at the gym, in the car, at the beach, on vacation or wherever the day takes you.\n---\nKeywords: protein shakes, no mess\n---\nFacebook Ad:\nConvenient smoothies and protein shakes anywhere, even around the house! With BlendJet, you can make a smoothie in 20 seconds! The BlendJet is our latest portable blender, made so you can take it anywhere in the world, and make whatever you want wherever you are. It’s easy to use right out of the box—just add your ingredients, press a button and enjoy! No mess, no hassle and practically cleans itself!\n---\nName: Eyeology Eye Massager\nProduct Description: The Eyeology Eye Massager uses safe air compression technology and adopts kneading, trigger point therapy and rhythmic percussion massaging to give you the gentle touch you need to battle against headaches, eye strain, sleeping problems, stress and more. \n---\nKeywords: relieve migraines, reduces eye-bags, improves sleep\n---\nFacebook Ad:\nThe Eyeology Eye Massager is designed to provide your eyes with the gentle touch they need for combating headaches, eye strain, sleeping problems, stress and more. The unique air compression technology offers a safe alternative to manual pressure techniques that could result in injury or establish an undesirable habit when used too frequently.\n\n🧠 Relieves Migraines In Minutes\n👀 Helps with Dry & Tired Eyes\n👁 Reduces Eye-Bags & Dark Under-Eye Circles\n💤 Improves Sleep Quality\n---\nName: Allbirds\nProduct Description: Take stormy weather in stride with the running shoe that uses natural materials to give you extra grip, plus a mid cut knit sock collar to keep your feet warm and dry.\n---\nKeywords: rubber sole,  4mm midsole\n---\nFacebook Ad:\nThe Allbirds running shoe is a game-changing approach to winter running and the ultimate in comfort. Striking the perfect balance between traction and lightness, our rubber sole brings refined grip for climbing hillsides or tracing an icy trail while also ensuring better protection from snow, slush, dirt clings, pockets of runoff water and all other hazards that accompany you on your adventures outside during these upcoming colder months. The high stretch knit upper provides both warmth and breathability without sacrificing support with a 4mm forefoot cushioning midsole for comfort.\n---\nName: Away\nProduct Description: Our Large checked suitcase is built to last, with a durable polycarbonate hard shell and 360° spinner wheels that ensure a smooth ride. Plus, its interior compression system and hidden laundry bag make packing that much easier.\n---\nKeywords: 40% recycled, eco-friendly\n---\nFacebook Ad:\nThe Away Large Checked suitcase is built to last. Designed for durability, convenience, and style this piece has everything you need to look professional whether you’re heading out for a two-week business trip or going on a family getaway abroad. Not only does it have durable polycarbonate hard shell with 360° rotating wheels that will allow you to glide through the airport effortlessly but also comes equipped with interior compression system and clever hidden laundry bag so packing your clothes just became easier than ever before. With 40% recycled premium material, this suitcase is eco-friendly and worry free unlike other big brands.\n---\nName: Spirit\nProduct Description: Open your door to the world of grilling with the sleek Spirit II E-210 gas grill. This two burner grill is built to fit small spaces, and packed with features such as the powerful GS4 grilling system, iGrill capability, and convenient side tables for placing serving trays. Welcome to the Weber family.\n---\nKeywords: home, variety of tools\n---\nFacebook Ad:\nThe Spirit II E-210 is the ideal grill to invite friends to enjoy your home-cooked food. It has a sleek design that will fit with any backyard, and is perfect for entertaining small groups of guests. It’s equipped with a powerful GS4 grilling system which provides an even heating surface that will cook your food evenly. You can control the temperature with the digital control panel, which allows you to set the temperature and timer. The side tables are perfect for serving food, and the porcelain enameled cast iron cooking grates ensure even heat distribution as you cook. Welcome to the Weber family.\n---\nName: Zameen\nProduct Description: Online platform for real estate. Buy and sell houses and land\n---\nKeywords: Pakistan, Property\n---\nFacebook Ad:\nZameen is Pakistan’s leading online platform for all real estate needs. We provide you with the best options for buying and selling your property, with a wide range of listings available on our website. With a secure and hassle-free platform, we allow you to easily search for your desired property by location or price range, and view all the vital information you need to make an informed decision.\n---\nName:{{$brand_name}}}\nProduct Description: {{$product_description}}\n---\nKeywords: {{$key_words}}\n---\nFacebook Ad: {{ Output }}\n',
      'icon_path' => '/assets/admin/images/newTemplate/facebook-new.png',
      'color_code' => '#3b5998',
      'icon_path_inverse' => '<i class="fab fa-facebook" style="color: #3737AA;"></i>',
      'category' => 'product',
      'temperature' => 0.7,
      'max_tokens' => 160,
      'top_p' => 1,
      'frequency_penalty' => 0,
      'presence_penalty' => 0.1,
      'stop' => '---',
      'status' => 'active',
    ];

    $ToolItemsArr = [
      [
        'input_title'               => 'Brand Name',
        'input_info_text'           => '',
        'input_info_placeholder'    => 'e. g. Typeskip',
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
