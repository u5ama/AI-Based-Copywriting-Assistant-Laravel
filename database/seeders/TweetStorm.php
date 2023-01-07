<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TweetStorm extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $ToolArr = [
      'title' => 'TweetStorm',
      'short_description' => 'Create valuable TweetStorms to create engagement on Twitter.',
      'uri' => 'tweetstorm',
      'context' => 'Write tweets using the given topic:\n---\nTopic: Tweets on how to launch a product\n---\nAudience: Entrepreneurs\n---\nTweets: \n1: Write out the spec of the launch in a detailed memo. Decide what type of launch this is:\n\n- New feature\n- Net new product\n- Site and product redesign\n- Improvements on existing feature\n\nAnswer the who, what, where, when, and why of the launch.\n\n2: Determine if this should be a small, medium, or large launch. Small - Small milestones and improvements on already existing features. Medium - A new feature that makes a clear difference in a current tool. Large - Net new product.\n\n3: Identify what specific group of people this launch is for. Is this for a subset of your current audience? Is this for a new audience entirely? Outline your niche and ideal customer personas.\n---\nTopic: Tweets on how to launch a product\n---\nAudience: Entrepreneurs\n---\nTweets:\nWant to start a business?\n\nHere are 5 ideas + strategies you can use to get started 🚀:\n\n1: Mission & Vision: Write a mission statement about why your company exists and a vision statement about where you want your brand to go.\n\n2: Target Audience: Describe who your customers are and why they need you (i.e. how your products or services solve their problems).\n\n3: Personality: Make a list of 3-5 adjectives that describe your brand. This will set the tone for both design and writing.\n\n4: Values: Determine the guiding principles for company decisions and actions.\n---\nTopic: Tweets on how to launch a product\n---\nAudience: Entrepreneurs\n---\nTweets:\nThe 4 best new productivity apps for 2021\n\nThese great apps will help you organize your digital life, avoid unwanted distractions, and more:\n\n1: A less-messy Gmail: Simplify Gmail is a revelation is a web browser extension centers your inbox so it’s easier to read, hides Google’s unnecessary app buttons, and tones down distracting colors. \n\n2: Write Minimalistically: As a minimalist writing tool, JotterPad cuts away features like adjustable fonts, colors, and page alignments, leaving only the words and a handful of basic formatting options to focus on. \n\n3: Illustrating on iPad: Let’s give Adobe its due, though. Last fall, the company brought Illustrator to the iPad, further making good on plans to treat Apple’s tablet as a first-class productivity tool. \n\n4: Focus on the work: As an alternative to Zoom, Around tries to fight video call fatigue by putting less emphasis on people’s faces.\n---\nTopic: Tweets on how to launch a product\n---\nAudience: Entrepreneurs\n---\nTweets:\nThe 4 best new productivity apps for 2021\n\nThese great apps will help you organize your digital life, avoid unwanted distractions, and more:\n\n1: A less-messy Gmail: Simplify Gmail is a revelation is a web browser extension that centers your inbox so it’s easier to read, hides Google’s unnecessary app buttons, and tones down distracting colors. \n\n2: Write Minimalistically: As a minimalist writing tool, JotterPad cuts away features like adjustable fonts, colors, and page alignments, leaving only the words and a handful of basic formatting options to focus on. \n\n3: Illustrating on iPad: Let’s give Adobe its due, though. Last fall, the company brought Illustrator to the iPad, further making good on plans to treat Apple’s tablet as a first-class productivity tool. \n\n4: Focus on the work: As an alternative to Zoom, Around tries to fight video call fatigue by putting less emphasis on people’s faces.\n---\nTopic: {{$topic}}\n---\nAudience: {{$product_description}}\n---\nTweets:',
      'icon_path' => 'public/ts/images/new-icons/twitter-icon-73.png',
      'color_code' => '#1DA1F2',
      'icon_path_inverse' => '<i class="fab fa-twitter" style="color: #1DA1F2;"></i>',
      'category' => 'twitter',
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
        'input_title' => 'Topic',
        'input_info_text' => '',
        'input_info_placeholder' => 'How to write engaging Tweets',
        'slug' => 'UserTopic',
        'required' => 1,
        'input_limit' => 80,
        'input_type' => 'input',
        'status' => 'active',
        'key' => 'topic',
      ],
      [
        'input_title' => 'Product Description',
        'input_info_text' => '',
        'input_info_placeholder' => 'e.g. Marketers',
        'slug' => 'UserAudience',
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
