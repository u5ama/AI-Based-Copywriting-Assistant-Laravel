<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersuasiveBulletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ToolArr = [
            'title' => 'Persuasive Bullet Points',
            'short_description' => 'Write persuasive bullet points using product description.',
            'uri' => 'persuasive-bullet-points',
            'context' => 'Write persuasive bullet points using product description:\n---\nProduct Name: Pushpress\n---\nProduct Description: Gym software that allows owners to automate gym class scheduling and payroll for trainers.\n---\nTone of Voice: Professional\n---\nOutput:\n• Reduce time spent scheduling classes and payroll\n• Help trainers make decisions about training sessions\n• Simplify HR management for your gym\n---\nProduct Name: TypeSkip\n---\nProduct Description: Gym software that allows owners to automate gym class scheduling and payroll for trainers.\n---\nTone of Voice: Professional\n---\nOutput:\n• TypeSkip is the AI-powered text generator that creates winning copy, content and marketing materials easily\n• Generate high quality, high converting copy in seconds\n• Get completely done for you content without any work at all \n• Save time by generating compelling copy \n---\nProduct Name: Quickbands\n---\nProduct Description: Resistance bands that help you workout anytime and anywhere. Turn your house into a personal gym.\n---\nTone of Voice: Professional\n---\nOutput:\n• Affordable and versatile- resistance bands can be used anytime or anywhere\n• No more excuses for not working out\n• Tighten and tone any way you want to\n---\nProduct Name: Quickbands\n---\nProduct Description: Resistance bands that help you workout anytime and anywhere. Turn your house into a personal gym.\n---\nTone of Voice: Professional\n---\nOutput:\n• Affordable and versatile- resistance bands can be used anytime or anywhere\n• No more excuses for not working out\n• Tighten and tone any way you want to\n---\nProduct Name: {{$brand_name}}\n---\nProduct Description: {{$product_description}}\n---\nTone of Voice: {{$key_words}}\n---\nOutput:\n',
            'icon_path' => '/assets/admin/images/newTemplate/persuasive-bullet-point.png',
            'color_code' => '#0F9D58',
            'icon_path_inverse' => '<i class="fas fa-map" style="color: #FE5C5A;"></i>',
            'category' => 'product',
            'temperature' => 0.7,
            'max_tokens' => 64,
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
