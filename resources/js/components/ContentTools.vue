<template>
    <div class="row cards-body">
        <div v-for="tool in searchTools(toolData)" class="col-lg-3">
            <a :href="tool.uri">
                <div class="sc-iWFSnp cmuvkJ">
                    <div class="sc-dRPiIx esbyIi">
                        <div class="dash-ln">
                            <h4 style="text-align: left; font-weight: 600; margin-left: 9px;">
                                <img class="img-fluid" :src="tool.icon_path" alt="facebook.png">
                            </h4>
                            <h4> {{ tool.title }} </h4>
                        </div>
                        <p>{{ tool.short_description }} </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</template>
<script>

    export default {
        props: ["tools","search"],
        data() {
            return {

                hard_tools:[
                    {
                        title:'New Facebook Ad',
                        category:'facebook',
                        short_description:'A limitless supply of orignal Facebook Ad Copy',
                        uri:'facebook-ad',
                        icon_path:'public/ts/images/new-icons/facebook.png'
                    },
                    {
                        title:'New Google Ad',
                        category:'google',
                        short_description:'Create Google Ad with exact requirement and layouts',
                        uri:'google-ad',
                        icon_path:'public/ts/images/new-icons/google-symbol.png'
                    },
                    {
                        title:'Product Description',
                        category:'blog',
                        short_description:'Launching a new product? Let\'s couple it with a catchy product description',
                        uri:'product-description',
                        icon_path:'public/ts/images/new-icons/product-description.png'
                    },
                    {
                        title:'Facebook video script',
                        category:'facebook',
                        short_description:'Create product descriptions that sell',
                        uri:'facebook-headline',
                        icon_path:'public/ts/images/new-icons/facebook.png'
                    },
                    {
                        title:'Content Improver',
                        category:'blog',
                        short_description:'Create compelling product descriptions to be used websites emails and social media.',
                        uri:'/copypaste',
                        icon_path:'public/ts/images/new-icons/sentenceimprover.png'
                    },
                    {
                        title:'PAS Framework',
                        category:'blog',
                        short_description:'Generate Problem - Agitate - Solution using product Description.',
                        uri:'/pas-ad',
                        icon_path:'public/ts/images/new-icons/pas-framework.png'
                    },
                    {
                        title:'AIDA Principle',
                        category:'blog',
                        short_description:'Write Attention, Interest, Desire, Action using product description.',
                        uri:'/aida-ad',
                        icon_path:'assets/admin/images/newTemplate/aida-principal.png'
                    },
                    {
                        title:'Sentence Expander',
                        category:'blog',
                        short_description:'Expand the given paragraphs into longer paragraphs.',
                        uri:'/sentence-ad',
                        icon_path:'assets/admin/images/newTemplate/sentence-expander.svg'
                    },
                    {
                        title:'Blog Outline',
                        category:'blog',
                        short_description:'Write an outline for a blog post using the title.',
                        uri:'/blog-ad',
                        icon_path:'assets/admin/images/newTemplate/blog-outline.svg'
                    },
                    {
                        title:'Great Headlines',
                        category:'blog',
                        short_description:'Create high quality headlines in seconds.',
                        uri:'/great-ad',
                        icon_path:'assets/admin/images/newTemplate/headline-generator.svg'
                    },
                    {
                        title:'Persuasive Bullet Points',
                        category:'blog',
                        short_description:'Write differentPersuasive Bullet Points using Product Description.',
                        uri:'/persuasive-ad',
                        icon_path:'assets/admin/images/newTemplate/persuasive-bullet-point.png'
                    },
                    {
                        title:'Marketing Angles',
                        category:'product',
                        short_description:'Write different marketing angles using Product Description.',
                        uri:'/marketing-ad',
                        icon_path:'assets/admin/images/newTemplate/marketing-angles.png'
                    },
                ]
            }
        },

        computed: {
            toolData: function () {
                return this.tools.concat(this.hard_tools).sort((a, b) => a.category.localeCompare(b.category));
                /*let opts = {}
                Object.assign(opts, this.tools, this.hard_tools)
                Object.entries(opts).sort((a, b) => a[1].category.localeCompare(b[1].category))
                console.log(opts)
                return opts*/
            }
        },
        mounted() {
            //this.tools.concat(this.hard_tools)

        },
        methods: {
            searchTools: function(tools) {
                if(this.search){
                    return tools.filter(tool => {
                        return tool.title.toLowerCase().includes(this.search.toLowerCase());
                    });
                }else{
                    return tools;
                }
            }
        },
    };
</script>
