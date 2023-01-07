<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GMBUpdatesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $ToolArr = [
      'title' => 'Google My Business Updates',
      'short_description' => 'Keep your customers in the know on Google',
      'uri' => 'GMBUpdates',
      'context' => 'Write a Google My Business Description using Product Description:\n---\nProduct Name: Pushpress\n--- \nDescription: Pushpress allows your gym to schedule and manage Gym Classes online.\n---\nProduct description:\nPushpress is a powerful and easy-to-use online booking system for your fitness facility. It makes it easier than ever to schedule classes, manage memberships, process payments, and more. If you`ve been looking for an affordable solution that will help you grow your business then look no further. Pushpress has the best features at the best price!\n---\nProduct Name: Candlesmith\n--- \nDescription: Candlesmith sells hand-poured candles with amazing fragrances that are made in the UK.\n---\nProduct description:\nCandlesmith was founded in 2012 by siblings, James and Charlotte. They wanted to create a sustainable business that would allow them to work together as well as with other talented people. Candlesmith started off selling candles on Etsy but quickly grew from there into what it is today - a lifestyle brand consisting of handmade English candles in an array of sophisticated scents. The company uses natural ingredients including soy wax, cotton wicks and high-quality fragrances which are made in the UK and shipped fresh worldwide. \nThe hand-poured candles come in glass jars or tins for easy storage or gifting; they last up to 50 hours each so youll have plenty of time to enjoy your purchase! \n---\nProduct Name: QuickBands\n--- \nDescription: Quickbands are resistance bands that you can attach to any door which helps you workout at home and on the go\n---\nTone of Voice: Professional\n---\nProduct description:\nQuickbands are a set of resistance bands that attach to any door. This simple yet effective design allows you to work out anytime and anywhere, without the need for bulky gym equipment or expensive memberships. Quickbands come in four different levels of resistance so whether your just getting started or looking for more advanced workouts, theres something for everyone.\n---\nProduct Name: AllBirds\n--- \nDescription: AllBirds are super comfortable knit shoes made from wool.\n---\nTone of Voice: Professional\n---\nProduct description:\nAllbirds are comfortable, sustainable, and stylish shoes. They are made from wool that doesnt itch because its antimicrobial and moisture-wicking. The design is sleek enough to wear with a suit or jeans (or both). They come in a variety of colors that will go with anything you own. Allbirds are not just for anyone; they are for the good people who want to make an impact on the world by wearing comfortable shoes without sacrificing style.\n---\nProduct Name: Goli\n--- \nDescription: Goli gummies are apple cider vinegar gummies. Helps improve digestion, become more energetic, and get clearer skin.\n---\nTone of Voice: Professional\n---\nProduct description:\nGoli gummies are a delicious, healthy way to get the benefits of apple cider vinegar. They taste like candy and come in three flavors- green apple, strawberry banana, and mixed berry. Plus they are gluten-free, vegan, non-gmo, and made with all-natural ingredients. Goli is perfect for people who dont love the taste of apple cider vinegar or cannot stomach it because it helps improve digestion and become more energetic while also getting clearer skin. Give them a try!\n---\nProduct Name: Philadelphia Business Lawyer Sarah Holmes \n--- \nDescription: We are offering flat fee legal packages to small business owners. Whether you need a contract drafted, investor agreement or a full start-up package, Attorney Holmes provides help in a hands-on, no-nonsense manner.\n---\nTone of Voice: Professional\n---\nProduct description:\nBusiness announcement:  We are here to help you build your small business and want to make sure you know about our flat fee legal packages. If you need contracts, start-up packages or any other legal needs, we all get the job done right the first time for a low price that wont break your bank! Contact us today for more information on how we can help building your dream company.  We look forward to hearing from you soon!\n---\nProduct Name:  The Fanklin Bar\n--- \nDescription: We have a new dish on the menu: Jumbo Lump Crab Cake, Truffle Mash, Sauteed Spinach \n---\nTone of Voice: Casual\n---\nProduct description:\nWe are not sure if you heard, but we have a new dish on the menu! Our Jumbo Lump Crab Cake is served with Truffle Mashed Potatoes and Sauteed Spinach. Its perfect for lunch or as an appetizer before dinner. We hope you will stop by to try it soon! Remember, The Franklin Bar has been cooking up dishes in Nashville since 1884. For more information please visit our website at http://www.thefranklinbar.com/menu/dinner/. Have any questions about this new dish? Send us an email today!\n---\nProduct Name:  Houwzer Realtors\n--- \nDescription: For sale in Philadelphia, PA. 4 Bed / 2 Bath home for $359,900. Contact me to learn more.\n---\nTone of Voice: Professional\n---\nBusiness announcement:  \nLoving this 4 beds, 2 baths home for sale in Philadelphia? It has a lot of potential and I am ready to help you make it your own. Houwzer Realtors is here for all your real estate needs. Contact me today to learn more about the property or schedule an appointment with one of our agents. We hope we can be part of your next big move! Houwzer Realtors - Philadelphias Choice For Real Estate.\n---\nProduct Name: {{$brand_name}}\n--- \nDescription: {{$product_description}}\n---\nTone of Voice:\n---\nBusiness Announcement:',
      'icon_path' => '/assets/admin/images/newTemplate/google-symbol.png',
      'color_code' => '#1DA1F2',
      'icon_path_inverse' => '<i class="fab fa-google" style="color: #1DA1F2;"></i>',
      'category' => 'GMB',
      'temperature' => 0.7,
      'max_tokens' => 100,
      'top_p' => 1,
      'frequency_penalty' => 0,
      'presence_penalty' => 0,
      'stop' => '---',
      'status' => 'active',
    ];

    $ToolItemsArr = [
      [
        'input_title' => 'Product Name',
        'input_info_text' => '',
        'input_info_placeholder' => 'e.g Press It',
        'slug' => 'ProductName',
        'required' => 1,
        'input_limit' => 80,
        'input_type' => 'input',
        'status' => 'active',
        'key' => 'brand_name',
      ],
      [
        'input_title' => 'Product Description',
        'input_info_text' => '',
        'input_info_placeholder' => 'e.g. Marketers',
        'slug' => 'ProductDescription',
        'required' => 1,
        'input_limit' => 400,
        'input_type' => 'textarea',
        'status' => 'active',
        'key' => 'product_description',
      ],
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
