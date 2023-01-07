<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ToolArr = [
            'title' => 'Product Description',
            'short_description' => 'Launching a new product? Let\'s couple it with a catchy product description.',
            'uri' => 'product-description',
            'context' => '',
            'icon_path' => '/assets/admin/images/newTemplate/product-description.png',
            'color_code' => '#1DA1F2',
            'icon_path_inverse' => '<i class="fab fa-product-hunt" style="color: #FF8227;"></i>',
            'category' => 'product',
            'temperature'       => 0.7,
            'max_tokens'        => 160,
            'top_p'             => 1,
            'frequency_penalty' => 0,
            'presence_penalty'  => 0.1,
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
