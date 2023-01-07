<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SentenceExpanderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ToolArr = [
            'title' => 'Sentence Expander',
            'short_description' => 'Expand the given paragraphs into longer paragraphs.',
            'uri' => 'sentence-expander',
            'context' => 'Expand the given paragraphs into longer paragraphs:\n---\nInput: Visiting Victoria is a wonderful experience because you can see both historic buildings and beautiful nature. \n---\nOutput:\nVisiting Victoria is a wonderful experience because you can see both historic buildings and beautiful nature. The city is surrounded on three sides by the Pacific Ocean, so it has many protected harbors, secluded bays, and fascinating beaches. Many postcards from Victoria show the busy Inner Harbour in the center of town. From the Tourist Office at one end of the harbor you can \n---\nInput: The tree was tall and green.\n---\nOutput:\nThe soft and damp pink flowers of the dogwood tree smelled sweet in the cool spring air as the wind whistled through its yellow-green leaves.\n---\nInput: Staring blankly at my exam, I tapped my pencil rapidly on the side of my desk.\n---\nOutput:\nThe class was silent, everyone focused on their own exam. Some scribbled madly, clawing at any idea that would save their lives. Some just stared hopelessly at the paper, trying to find some hidden meaning in the question.\n---\nInput: The tree was tall and green.\n---\nOutput:\nThe soft and damp pink flowers of the dogwood tree smelled sweet in the cool spring air as the wind whistled through its yellow-green leaves.\n---\nInput: Big tech companies like Google and Facebook have so much data stored on their users, they understand them on a deeper level than a human brain ever could.\n---\nOutput:\nDue to the sheer volume of user data these companies gather, and their deep level of personal understanding, its entirely possible that we are now also entering an era where the mega-corporations will understand us on a deeper level than our OWN brains ever could.\n---\nInput: Big tech companies like Google and Facebook have so much data stored on their users, they understand them on a deeper level than a human brain ever could.\n---\nOutput:\nDue to the sheer volume of user data these companies gather, and their deep level of personal understanding, its entirely possible that we are now also entering an era where the mega-corporations will understand us on a deeper level than our OWN brains ever could.\n---\nInput: With more and more commerce happening online, customers expect to interact with their brands holistically—sometimes buying, sometimes checking in on social media, sometimes buying immediately, other times waiting a week to buy.\n---\nOutput:\nWith more and more commerce happening online, customers expect to interact with their brands holistically—sometimes buying, sometimes checking in on social media, sometimes buying immediately, other times waiting a week to buy. For those building consumer Internet businesses, understanding that customers are going to be doing all these things in this way means a very different set of priorities for creating brand experiences. It also means the company needs to build up a really awesome funnel.\n---\nInput: These days, people are more interested in their phones than they are in the world around them.\n---\nOutput:\nThese days, people are more interested in their phones than they are in the world around them. The New York Times has reported that the average American checks their phone every six and a half minutes. And they are not just checking for texts. Many people spend a significant amount of their time using apps to shop, travel, read the news, and so on.\n---\nInput:{{$product_description}}\n---\nOutput: {{ Output }} \n',
            'icon_path' => '/assets/admin/images/newTemplate/sentence-expander.png',
            'color_code' => '#FFFC00',
            'icon_path_inverse' => '<i class="fas fa-expand" style="color: #FE5C5A;"></i>',
            'category' => 'product',
            'temperature' => 0.7,
            'max_tokens' => 170,
            'top_p' => 1,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.05,
            'stop' => '---',
            'status' => 'active',
        ];

        $ToolItemsArr = [
            [
                'input_title'               => 'Input',
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
