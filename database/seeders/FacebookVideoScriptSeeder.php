<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacebookVideoScriptSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $ToolArr = [
      'title' => 'Facebook Video Script',
      'short_description' => 'Create video script for Facebook ads using a short description and keywords',
      'uri' => 'facebook-headline',
      'context' => 'Write a script for an advertisement using product description\n-----------\nName: Visight Massager\nInput: Your eyes require special care. Whether it\'s from everyday eye fatigue from using computers, reading or watching TV, or if you suffer from headaches, insomnia, and even eyebags - Visight Massager will help to relieve all these problems. The scientifically-proven and patented combination of acupoint, warmth, and vibration massage plus music is a proven solution for the optimum care of your eyes.\n-----------\nOutput: \nProblem: Suffering from insomnia and headaches?\nSolution: Visight Massager relieves migraines and headaches in minutes using a combination of acupoint, warmth and vibrations.\nBenefit 1: Visight massages your acupoints on your templates, and uses heat therapy to give you spa-like experience right at home.\nBenefit 2: The vibration massage helps you relax your eyes, relieving eye fatigue, insomnia and eyebags.\nBenefit 3: it is a proven solution for optimum care of your eyes and never struggling with headaches again.\nCTA: Shop now before we run out of stock.\n-----------\nName: Mosquito Zapper\nDescription: Introducing The Mosquito Zapper. Light up your world and stop disease carrying Mosquitos and other pesky insects with a simple push of a button. It’s Non-toxic, Kid-Safe And Pet Friendly. Push one button to activate the powerfully bright 3 mode (High-Medium-Low) 180 lumen lantern. It’s waterproof and built to last. For indoor and outdoor use.\n-----------\nScript: \nProblem: Mosquitoes in your house and yard can be a nuisance\nSolution: Introducing The Mosquito Zapper. Light up your world and stop disease carrying insects of all kinds with a simple push of a button.\nBenefit 1: It’s Non-toxic, Kid-Safe And Pet Friendly making sure it’s safe for all ages.\nBenefit 2: Durable, Lightweight, and water resistant to withstand any weather conditions, so you can enjoy life outside 24 hours a day without fear!\nBenefit 3: It has 3 Lantern Modes\nCTA: Shop now\n-----------\nName: BlendJet\nDescription: We created the BlendJet portable blender so you can make anything healthy smoothies, anywhere in the world — from a mountaintop to your kitchen countertop. It’s easy and convenient to use at home, at work, outdoors, at the gym, in the car, at the beach, on vacation or wherever the day takes you.\n-----------\nScript:\nProblem: Are you feeling bloated and struggling to eat healthy?\nSolution: BlendJet Portable Blender allows you to make healthy smoothies anywhere! \nBenefit 1: It’s easy to use - start the blender with a push of a button\nBenefit 2: It’s convenient - use it anytime you want a smoothie\nBenefit 3: It’s portable making it perfect for smoothies on the go\nCTA: What are you waiting for?\n-----------\nName: Frisco\nDescription: The Frisco pet bed is a rectangular bed that will keep any pet comfortable. It is made of high quality, comfy materials that are built to last.\n-----------\nScript: \nProblem: Are your pets unable to sleep in their hard and uncomfortable beds? \nSolution: Let your pets snooze the day away with the highly comfortable Frisco pet bet.\nBenefit 1: It’s soft and comfortable\nBenefit 2: It’s easy to clean\nBenefit 3: It’s durable\nCTA: Click to learn more\n-----------\nName:{{$brand_name}}\n Description: {{$product_description}}\n---\nKeywords: {{$key_words}} \n-----------\nScript: {{ Output }}',
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
