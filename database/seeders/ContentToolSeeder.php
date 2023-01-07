<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContentToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ToolArr = [
            'title' => 'Instagram Product Post',
            'short_description' => 'Create compelling posts for instagram',
            'uri' => 'instagram-post',
            'context' => 'Write an Instagram Caption for a product using image description:\n---\nName: Coco Kind\n---\nImage Description: A woman holding Coco Kind sunscreen\n---\nProduct Description: This lightweight, non-irritating mineral-based daily sunscreen lotion with SPF 32 uses non-nano zinc oxide, blue phytoplankton, and microalgae to protect skin against everyday stressors such as UVA rays (aging) and UVB rays (burning), pollution blue light\nin doing so, it helps prevent signs of premature aging, such as dark spots, fine lines, and wrinkles while protecting skin against sunburn. \n---\nInstagram Caption: \nDo you carry spf in your bag on the go? Here\'s why you should! \nRegardless of the SPF number, the sun\'s rays actually break down all sunscreens with exposure. Even the recommended amount of SPF will naturally break down on your skin over time when exposed to sunlight. Without reapplication, you\'re more at risk for skin damage from UV rays, so we always recommend reapplying every two hours (or after coming into contact with water) to keep skin protected.\n---\nName: JetPack Protein Smoothies\n---\nImage Description: Woman adding JetPack Smoothie powder to milk.\n---\nProduct Description:  We partnered with culinary experts behind some of the most iconic beverages in the world to craft the perfect formulas to fuel your body and flavors to delight your taste buds. Designed for use with your BlendJet portable blender, each single-serving JetPack Protein Smoothie is loaded with 15 grams of plant-based protein, plus the freshest fruits picked at peak ripeness.\n---\nInstagram Caption: \nFuel to feel good. 💪\n\nGet your protein fix anywhere with our NEW JetPack Protein Smoothies. 🍓🍌 Made with real pieces of freeze-dried fruit and 15g of plant-based protein, they\'re packed with nutrients and bursting with fresh fruit flavor.\n---\nName: Acupressure Gua Sha Spoon\n---\nImage Description: Image of Acupressure Gua Sha Spoon in its box\n---\nProduct Description:  Designed specifically for more precise work and a deeper massage, this tool can help sculpt facial features like the cheeks, drain puffiness from the face, melt facial tension through acupressure points, and release jaw tension.\n---\nInstagram Caption:\nOur Acupressure Gua Sha Spoon is designed for a deeper massage and more precise sculpting. Use it on acupressure points, the cheekbones + along the jaw and feel tension melt away. \n---\nName: Avacado Serum\n---\nImage Description: Picture of Avacado Serum.\n---\nProduct Description:  Reduce visible redness and support the skin barrier with the soothing and calming Avocado Ceramide Recovery Serum. Formulated to target dehydration, irritation, and redness, this lightweight milky texture wraps sensitive skin in a healing layer of actives to restore skin to its natural, healthy state. This innovative recipe is created with a blend of powerful plant-based ingredients such as nutrient-rich avocado extract + butter, strengthening ceramides, and calming allantoin and rice milk to help strengthen and recover irritated, compromised skin.\n---\nInstagram Caption:\nOur favorite when we need a major boost of soothing hydration. ✨ Here\'s how our Avacado Serum works to nourish skin so you can glow: Avocado Serum actively soothes skin while strengthening the skin barrier with 5 skin-identical ceramides, allantoin, rice milk, and avocado.\n---\nName: Aloe Gua Sha\n---\nImage Description: Woman using the Aloe Gua Sha Jade Roller on her face\n---\nProduct Description: The jade facial roller is a Chinese skincare tool that has been used for thousands of years. Perfected throughout the centuries, this facial massager was built to have a de-puffing, soothing effect on the skin.\n---\nInstagram Caption: The Jade Facial Roller is a facial massage tool that\'s been used in Chinese skincare for thousands of years. Use it after cleansing to de-puff the skin + soothe with a gentle massage + the cooling effects of the jade. The Aloe Gua Sha Jade Roller is perfect for sensitive skin types and can be used on the face and neck to release stress.\n---\nImage Description: {{$ImageDescription}}\n---\nProduct Description: {{$ProductDescription}}\n---\nInstagram Caption:',
            'icon_path' => 'public/ts/images/new-icons/instagram.png',
            'color_code' => '#1DA1F2',
            'icon_path_inverse' => '<i class="fab fa-instagram" style="color: #1DA1F2;"></i>',
            'category' => 'instagram',
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
                'input_title' => 'Image Description',
                'input_info_text' => '',
                'input_info_placeholder' => 'Wedding Cake on table',
                'key' => 'ImageDescription',
                'slug' => 'ImageDescription',
                'required' => 1,
                'input_limit' => 400,
                'input_type' => 'textarea',
                'status' => 'active',
            ],
            [
                'input_title' => 'Product Description',
                'input_info_text' => '',
                'input_info_placeholder' => 'e.g. Our three tiered, chocolate cake is perfect for your wedding',
                'key' => 'ProductDescription',
                'slug' => 'ProductDescription',
                'required' => 1,
                'input_limit' => 400,
                'input_type' => 'textarea',
                'status' => 'active',
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
