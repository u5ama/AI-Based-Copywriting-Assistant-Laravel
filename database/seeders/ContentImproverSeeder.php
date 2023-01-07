<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContentImproverSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $ToolArr = [
      'title' => 'Content Improver',
      'short_description' => 'Quickly improve your content using the content improver tool',
      'uri' => 'copy-paste',
      'context' => 'Input:\n We arrived at the airport. We saw that our plane would be late. Robin took advantage of the delay to go to the newsstand. She looked for a paperback to read on the plane. I went directly to the gate. I realized I should have told Robin to buy me gum. Robin got to the gate. She told me she\'d thought of it. She handed me a pack of gum. It was my favorite.\n-----------\nOutput:\n When we arrived at the airport, we saw that our plane would be late. Robin decided to take advantage of the delay to go to the newsstand and look for a good paperback to read on the plane, but I decided to go directly to the gate. It was then that I realized that I should have told Robin to buy me some gum. Fortunately, when Robin got to the gate, she told me that she\'d thought of it herself. She handed me a pack of my favorite gum.\n-----------\nInput:\n I attended a concert last night, and the orchestra performed several compositions that were themes from stage musicals, and my date told me that they were some of his favorite songs; but he also liked some of the more classical pieces that the orchestra performed, like the concertos, and he hoped they would do more of those the next time we had tickets.\n-----------\nOutput: I attended a concert last night, and the orchestra performed several compositions that were themes from stage musicals. My date told me that they were some of his favorite songs, but he also liked some of the more classical pieces that the orchestra performed, like the concertos. He said that he hoped they would do more of those the next time we had tickets.\n-----------\nInput: During my time in office I have achieved several goals. I have helped increase funding for local schools. I have reduced crime rates in the neighborhood. I have encouraged young people to get involved in their community. My competitor argues that she is the better choice in the upcoming election. I argue that it is ridiculous to fix something that isn’t broken. If you reelect me this year, I promise to continue to serve this community.\n-----------\nOutput:\n During my time in office, I have helped increase funding for local schools, reduced crime rates in the neighborhood, and encouraged young people to get involved in their community. Why fix what isn’t broken? If you reelect me this year, I will continue to achieve great things for this community. Don’t take a chance on an unknown contender; vote for the proven success.\n-----------\nInput:\n They flooded the streets, swarming around people who looked like money, begging or picking pockets right in front of the police. They descended like locusts on the markets, until the merchants hired thugs to beat them away with sticks.\n-----------\nOutput:\n They descended like locusts on the markets, until the merchants hired thugs to beat them away with sticks. The streets were flooded with beggars and pickpockets, who seemed to swarm around anyone that looked like they had money.\n-----------\nInput:\n  The biggest issue with stereotyping today would be in the business world. Lets take hiring new employees as the main problem. It may not always be race that is a deciding factor as much as it is sex. Some jobs a woman may be hired over a man due to her nurturing nature. On the other hand a man may be hired over a woman due to the fact that he may be stronger. In some cases the sex of a person may be the deciding factor on whether they even get a call.\n-----------\nOutput:\nMuch of today’s stereotyping takes place in the business world, particularly when hiring employees. Surprisingly often, sex is more of a deciding factor than race. For some jobs women may be hired over men because they are seen as nurturers; on the other hand, men may be preferred because of their physical strength. \n-----------\nInput: {{$product_description}} \n-----------\nOutput: {{ Output }}',
      'icon_path' => '/assets/admin/images/newTemplate/sentenceimprover.png',
      'color_code' => '#FFFC00',
      'icon_path_inverse' => '<i class="fas fa-passport" style="color: #FE5C5A;"></i>',
      'category' => 'product',
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
        'input_title'               => 'Company or Product Description',
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
