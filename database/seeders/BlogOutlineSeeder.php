<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogOutlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ToolArr = [
            'title' => 'Blog Outline',
            'short_description' => 'Write an outline for a blog post using the title.',
            'uri' => 'blog-outline',
            'context' => 'Write an outline for a blog post using the title:\n---\nTitle: 5 Ways Digital Marketing is changing in 2020\nAudience: Marketers\n---\nOutline:\n1. Digital business pivots may become permanent.\n2. Social media will become a top channel for purchase, instead of just discovery.\n3. Virtual events started out of necessity, but are here to stay because of ROI and accessibility.\n4. Many companies are starting to reduce the number of social media channels they are using to share and influence to declutter their social media\n5. Augmented Reality will become more common in digital engagements\n---\nTitle: 6 ways to lose weight\nAudience: Casual\n---\nOutline:\n1. Eat a high protein breakfast\n2. Avoid sugary drinks and fruit juice\n3. Drink water before meals\n4. Keep track of your caloric intake so you know how many calories you are eating in one day \n5. Find an activity you enjoy doing that will help you lose weight\n6. Learn to cook healthy food at home and pack your lunch for work\n---\nTitle: How to train for a 5k\nAudience: Casual\n---\nOutline:\n1. Make sure you are physically able to run a 5K.\n2. Make enough time to train.\n3. Sign up for a race\n4. Get appropriate running gear\n---\nTitle: How to train for a 5k\nAudience: Casual\n---\nOutline:\n1. Make sure you are physically able to run a 5K.\n2. Make enough time to train\n3. Sign up for a race in your area\n4. Get appropriate running gear for the race\n---\nTitle: How to buy bitcoin\nAudience: Technical\n---\nOutline:\n1. Find a bitcoin wallet \n2. Create an account on a cryptocurrency exchange \n3. Transfer money to the exchange from your bank account or credit card \n4. Buy bitcoins with your newly transferred funds\n5. Store bitcoin in your wallet\n---\nTitle: How to make a sandwich\nAudience: Casual\n---\nOutline:\n1. Get the necessary ingredients for the sandwich\n2. Wash your hands before making the sandwich\n3. Cook the ingredients if required\n4. Toast the bread\n5. Layer your sandwich with desired ingredients\n6. Enjoy!\n---\nTitle: Blog post about the benefits of playing chess\nAudience: Casual\n---\nOutline:\n1. Playing chess can help improve your memory and critical thinking skills \n2. Its a great way to spend time with friends or family, even if you are not all on the same skill level \n3. Chess is a game that requires strategy and patience, which can lead to better decision-making in other areas of life\n4. You will learn how to focus on the present and think ahead in terms of what you want to do next \n---\nTitle: Blog post about the benefits of Keto\nAudience: Casual\n---\nOutline:\n1. What is Keto and how does it work\n2. The benefits of keto for weight loss, energy levels, and mental clarity\n3. What to eat on the keto diet \n4. How to start a keto diet \n5. Common misconceptions about the ketogenic diet \n6. Tips for sticking with your new lifestyle change\n---\nTitle: How Social Media is affecting our day to day lives\nAudience: Casual\n---\nOutline:\n1. Social media has changed the way we communicate\n2. Its changing how we interact with people and businesses\n3. Its changed our expectations of privacy\n4. The negative effects of social media on mental health are becoming more apparent\n5. There is a growing concern about the effect it has on children and young adults \n6. Social media can be addictive, leading to feelings of isolation when not using it or feeling like you need to use it constantly in order to stay connected with friends and family members\n---\nTitle: Driving more traffic to your e-commerce store in 2021\nAudience: Casual\n---\nOutline:\n1. Increase your social media presence by posting more often and interacting with other users\n2. Create a blog post series to help educate customers on how to use your product or service\n3. Offer free shipping for purchases over $50, which will encourage people to buy more items from you \n4. Add an FAQ section on the homepage of your website so that customers can find answers quickly without having to contact customer support \n5. Use pop-ups in between pages of your site - this will remind visitors about products they may have missed while browsing through the site \n6. Put up banners across popular websites where many potential customers browse (examples include Facebook, Twitter, Instagram) advertising discounts or new arrivals at your store\n---\nTitle: How to Make a Shopify Store\nAudience: Casual\n---\nOutline:\n1. What is Shopify and how does it work\n2. How to set up a store on Shopify\n3. How to create your first product listing \n4. How to add products from other websites \n5. How to customize the look of your store with themes, layouts, and colors \n6. Promoting your shop online through social media and email marketing campaigns\n---\nTitle: How to build a WooCommerce Store\nAudience: Casual\n---\nOutline:\n1. Install WooCommerce on your website\n2. Create a product feed to import all of your products from your suppliers site or store\n3. Add a payment gateway for credit card processing and set up the checkout process \n4. Set up shipping rates, including free shipping options \n5. Customize the design of your store with colors, fonts, and images that match your brand identity \n6. Promote it! Share it on social media channels like Facebook and Twitter as well as through email marketing campaigns to get more traffic to the site\n---\nTitle: {{$brand}}\nAudience: {{$product_description}}\n---\nOutline:\n',
            'icon_path' => '/assets/admin/images/newTemplate/blog-outline.svg',
            'color_code' => '#800080',
            'icon_path_inverse' => '<i class="fas fa-blog" style="color: #FE5C5A;"></i>',
            'category' => 'product',
            'temperature' => 0.7,
            'max_tokens' => 170,
            'top_p' => 1,
            'frequency_penalty' => 0.09,
            'presence_penalty' => 0.1,
            'stop' => '---',
            'status' => 'active',
        ];

        $ToolItemsArr = [
            [
                'input_title'               => 'Title',
                'input_info_text'           => '',
                'input_info_placeholder'    => 'e.g. 6 ways to lose weight',
                'slug'                      => 'brand-name',
                'required'                  => 1,
                'input_limit'               => 80,
                'input_type'                => 'input',
                'status'                    => 'active',
                'key'                       => 'brand_name'
            ],
            [
                'input_title'               => 'Audience',
                'input_info_text'           => '',
                'input_info_placeholder'    => 'e.g. Casual',
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
