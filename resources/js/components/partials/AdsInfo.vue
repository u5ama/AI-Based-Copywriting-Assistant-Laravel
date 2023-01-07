<template>
  <img v-if="adsInfo.ads_category == 'google'" src="/assets/admin/images/newTemplate/google-symbol.svg" />
  <img v-if="adsInfo.ads_category == 'product-description'" src="/assets/admin/images/newTemplate/product-description.png" />
  <img v-if="adsInfo.ads_category == 'facebook-headline'" src="/assets/admin/images/newTemplate/facebook.svg" />
  <img v-if="adsInfo.ads_category == 'facebook'" src="/assets/admin/images/newTemplate/facebook.svg" />
  <img v-if="adsInfo.ads_category == 'pas-framework'" src="/assets/admin/images/newTemplate/pas-framework.png" />
  <img v-if="adsInfo.ads_category == 'copy-paste'" src="/assets/admin/images/newTemplate/sentenceimprover.png" />

    <img v-if="adsInfo.ads_category == 'aida-principle'" src="/assets/admin/images/newTemplate/aida-principal.png" />
    <img v-if="adsInfo.ads_category == 'sentence-expander'" src="/assets/admin/images/newTemplate/sentence-expander.png" />
    <img v-if="adsInfo.ads_category == 'blog-outline'" src="/assets/admin/images/newTemplate/blog-outline.png" />
    <img v-if="adsInfo.ads_category == 'great-headlines'" src="/assets/admin/images/newTemplate/headline-generator.png" />
    <img v-if="adsInfo.ads_category == 'persuasive-bullet-points'" src="/assets/admin/images/newTemplate/persuasive-bullet-point.png" />
    <img v-if="adsInfo.ads_category == 'marketing-angles'" src="/assets/admin/images/newTemplate/marketing-angles.png" />

  <img v-if="adsInfo.ads_category == ''" src="/assets/admin/images/newTemplate/google-symbol.svg" />
  <div class="ccp-title-head">
    <span class="ccp-title">{{  adsInfo.ads_category? adsInfo.ads_category.split("-").join(" ") : 'Example' }}</span>
    <span class="ccp-time"> {{ contentDate }} </span>
  </div>
</template>

<script>
export default {
  name: "AdsInfo",
  props: ["adsInfo", "contentDate"],

};
</script>

<style scoped>
</style>
