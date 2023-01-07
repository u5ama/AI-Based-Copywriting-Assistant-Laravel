<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PASFrameworkSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $ToolArr = [
      'title' => 'PAS Framework',
      'short_description' => 'Generate Problem - Agitate - Solution using product Description.',
      'uri' => 'pas-framework',
      'context' => 'Generate Problem - Agitate - Solution using product Description:\n---\nName: Pushpress\n---\nProduct description: Pushpress allows your gym to schedule and manage Gym Classes online.\n---\nTone of Voice: Professional\n---\nProblem: Your gym is a community. You want to provide your members with an easy way for them to find out what\'s happening at the gym, and you also want a tool that lets you manage classes online.\n\nAgitate: Pushpress allows gyms to schedule and manage fitness classes online in one place, so that you can better engage with your members and increase retention rates.\n\nSolution: As soon as your members sign up for pushpress they\'ll be able to see upcoming class schedules, book their spot in advance or pay on arrival, view descriptions of each class (including photos), filter by instructor or time slot - all from their phone! They will also receive SMS reminders about booked classes which means no more missing workouts because they forgot! For instructors it\'s easy too - just login once to create new classes and upload photos/descriptions/schedule times etc., then sit back while people sign up!\n---\nName: Zameen\n---\nProduct description: Zameen is an online real estate platform where buyers can list land and houses and sellers can make offers to buy them\n---\nTone of Voice: Professional\n---\nProblem: Buying and selling land and houses in Pakistan is a cumbersome process. The real estate market is far from transparent, there are many middlemen involved, and the whole system lacks trust.\n\nAgitate: Zameen makes it easy to buy or sell any property online within minutes by connecting buyers with sellers directly. All you need to do is list your property on our website for free! We try to make the entire experience as simple as possible so that both buyers and sellers can save time, money, energy etc...\n\nSolution: Zameen provides a platform where everyone can get their dream home without going through the hassle of meeting multiple agents who only have their own interests in mind. It also helps people find good deals on land & houses which they can purchase immediately if they like what they see! Our user-friendly interface allows you to list properties quickly while making sure all information provided about them is accurate. You will be able to communicate directly with potential buyers via email or message.\n---\nName: Goli\n---\nProduct description: Goli gummies are apple cider vinegar gummies. Helps improve digestion, become more energetic, and get clearer skin.\n---\nTone of Voice: Professional\n---\nProblem: A lot of people are interested in taking apple cider vinegar but find it hard to take because the taste is so strong.\n\nAgitate: Goli gummies make it easier for you to get all the benefits of apple cider vinegar without having to deal with a bitter taste. The flavor is sweet and delicious, making it easy for anyone to take them daily.\n\nSolution: These gummies help improve digestion, become more energetic, and also clear up your skin! They\'re made with high-quality ingredients that provide real results. You can try these today by ordering from our website!\n---\nName: Blendjet\n---\nProduct description: We created the BlendJet portable blender so you can make anything you want, anywhere in the world — from a mountaintop to your kitchen countertop. It’s easy and convenient to use at home, at work, outdoors, at the gym, in the car, at the beach, on vacation or wherever the day takes you.\n---\nTone of Voice: Professional\n---\nProblem: Portable blenders are either too bulky and hard to clean, or they’re not powerful enough for the job.\n\nAgitate: Blending your favorite smoothie can be a hassle when you’re on the go. You have to schlep around heavy containers and hope that everything fits in your bag. And if you want to blend something more than just fruit, like ice cream or frozen yogurt, it becomes even harder. If you don’t have access to a blender at work or school, it can seem impossible to get a healthy meal in during the day.\n\nSolution: Blendjet is here for all of those situations — whether you need an extra boost of protein in the morning before work, want some fresh juice on your way home from class, or just need something cold after working out at the gym...Blendjet has got you covered! With Blendjet\'s portable blending technology built into its compact design (which fits conveniently into any bag.\n---\nName: AllBirds\n---\nProduct description: AllBirds are super comfortable knit shoes made from wool.\n---\nTone of Voice: Professional\n---\nProblem: Most shoes are made from leather, plastic and rubber. These materials don’t breathe well, which makes your feet sweat. This is bad for the environment and it also makes you stink!\n\nAgitate: AllBirds solve this problem by using wool instead of leather or plastic. Wool is a natural material that breathes really well so your feet stay cool and dry all day long. It also naturally absorbs odors so you can wear them longer before washing them!\n\nSolution: We use high-quality merino wool to make our shoes comfortable, soft and breathable so you can be active without smelling like a locker room at the end of the day!\n---\nName: {{$brand_name}}\n---\nProduct description: {{$product_description}}\n---\nTone of Voice:  {{$key_words}} \n---\n {{ Output }}',
      'icon_path' => '/assets/admin/images/newTemplate/pas-framework.png',
      'color_code' => '#800080',
      'icon_path_inverse' => '<i class="fas fa-copy" style="color: #FE5C5A;"></i>',
      'category' => 'product',
      'temperature' => 0.7,
      'max_tokens' => 204,
      'top_p' => 1,
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
