<template>
  <!--********************************************************
            Banner Section
    /********************************************************-->
  <div class="banner_overlay_Section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-12">
          <div class="layer1text pl-md-3 pr-md-0">
            <div class="hdrh2cls_typ">Let our AI</div>
            <div class="hdrh2cls" id="typed-text">
              Write Product Descriptions, Facebook ads, & more for you
            </div>
            <p class="mt-4 banner-para">
              Turn keywords and one-liners into persuasive, high converting ads,
              product descriptions, and blogs etc.
            </p>
            <div
              class="wow fadeInLeft text-left text-nd-left"
              data-wow-delay="1s"
              data-wow-duration="3s">
              <a :href="route('register')"
                class="lg-btn primary-btn ts-btn mt-4 banner-btn">Get Started - Free!</a>
              <small class="banner-small text-left text-nd-left">7-Day Free Trial</small>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-12">
          <div class="header_card_box">
            <div class="header_card_box_bg1 leftRight"></div>
            <div class="header_card_box_bg2 topBottom"></div>
            <div class="card-box">
              <!-- card header -->
              <div class="card-header">
                <div class="three-dots">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>

                <button id="reset">
                  <img src="https://typeskip.ai/assets/frontend/landing-images/reset.svg" alt="reset"/>Reset
                </button>
              </div>
              <!-- card header end -->

              <!-- card top -->
              <div class="card-top">
                <a href="#">
                    <img src="https://typeskip.ai/assets/frontend/landing-images/typeskip.png" alt="logo"/>
                </a>
              </div>
              <!-- card top end -->

              <!-- card main -->
              <div class="main-wrap">
                <!-- form -->
                <form class="rightform">
                  <input
                    @click="start_demo"
                    v-model="company"
                    id="name"
                    placeholder="Company Name"
                    readonly
                    dataValue="SwolePatrol"
                    width="500"
                    type="text"/>
                  <input
                    id="title"
                    placeholder="Tone of Voice"
                    readonly
                    v-model="title"
                    type="text"
                    step="1"/>
                  <textarea
                    id="textarea"
                    placeholder="Description"
                    readonly
                    v-model="textarea"
                    rows="3">
                  </textarea>
                  <div class="keywords" v-bind:class="{ shown: textarea }">
                    <span class="placeholder">Keywords</span>
                    <span class="keyword-item">
                      {{ tagOne }}
                      <button class="tag-remove"></button></span>
                    <span class="keyword-item ml-1">
                      {{ tagTwo }}
                      <button class="tag-remove"></button></span>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="outputs">
                      <input
                        id="nValue"
                        value="5"
                        type="number"
                        name="nValue"
                        min="1"
                        max="15"
                        aria-describedby="ideas"
                        autocomplete="off"
                        class="pr-20 form-input"/>
                    </div>
                    <button class="generate" @click="makeShowRes" type="button"><span class="btn-load"></span><span class="btn-txt">Generate</span></button>
                  </div>
                  <button class="playDemo" v-bind:class="{ hide: textarea }">Step 1: Play Demo</button>
                  <button type="button" class="hit-generate" v-bind:class="{ shown: hitGenMessage }">Step 2: Hit Generate!</button>
                </form>
                <!-- form end -->

                <!-- content box -->
                <div class="content-box" v-bind:class="{ show: showRes }">
                  <div class="box-empty">
                    <img src="https://typeskip.ai/assets//frontend/landing-images/demo.png" alt="" class="plane"/>
                    <p>Answer the prompts and click generate to watch the AI
                      magic happen ✨.
                    </p>
                  </div>
                  <ul>
                    <li>
                      <div class="card-item">
                        <p><b>Ad</b> • {{ generatedContent.url }} ▾</p>
                        <h3>
                          {{ generatedContent.heading }}
                        </h3>
                        <p>
                          {{ generatedContent.descriptionOne }}
                        </p>
                      </div>
                    </li>
                    <li>
                      <div class="card-item">
                        <p><b>Ad</b> • {{ generatedContent.url }} ▾</p>
                        <h3>
                            {{ generatedContent.headingTwo }}
                        </h3>
                        <p>
                        {{ generatedContent.descriptionTwo }}
                        </p>
                      </div>
                    </li>
                  </ul>
                </div>
                <!-- content box end -->
              </div>
              <!-- card main end -->
            </div>
            <div class="header_card_box_bg3 leftRight"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Banner",
  data() {
    return {
      company: null,
      title: "",
      textarea: null,
      showRes: false,
      hitGenMessage: false,
      tagOne: null,
      tagTwo: null,
      generatedContent : {},
      content: [
        {
          companyName:"SwolePatrol",
          tone:"Witty",
          inputDescription: "High quality honey cinnamon peanut butter whey protein",
          tagOne:"26G Protein",
          tagTwo:"Get results",
          url: "www.swolepatrol.com/",
          headingOne: "Tired of protein powders that taste like chalk?",
          headingOneTwo: "Two Tired of protein powders that taste like chalk?",
          descriptionOne: "Finally, protein made the way it should be. With 26g of protein per serving and a mouth watering honey cinnamon peanut butter flavor, gains have never tasted this good.",
          descriptionTwo: "Swole Patrol is a new type of protein powder made for the hard-gaining athlete. It’s loaded with 26G of muscle building protein and has a delicious Honey Cinnamon Peanut Butter flavor. But what really sets Swole Patrol apart from other proteins is how it’s made. We use an advanced process to make our whey isolate, which means you get more pure protein per serving than any other brand on the market!"
          },
        {
          companyName:"Facebook",
          tone:"facebook",
          inputDescription: "World wide social media and marketplace",
          tagOne:"media",
          tagTwo:"marketplace",
          url: "www.swolepatrol.com/",
             headingOne: "Tired of protein powders that taste like chalk?",
          headingOneTwo: "Two Tired of protein powders that taste like chalk?",
          descriptionOne: "Finally, protein made the way it should be. With 26g of protein per serving and a mouth watering honey cinnamon peanut butter flavor, gains have never tasted this good.",
          descriptionTwo: "Swole Patrol is a new type of protein powder made for the hard-gaining athlete. It’s loaded with 26G of muscle building protein and has a delicious Honey Cinnamon Peanut Butter flavor. But what really sets Swole Patrol apart from other proteins is how it’s made. We use an advanced process to make our whey isolate, which means you get more pure protein per serving than any other brand on the market!"
          },
        {
          companyName:"Typeskip",
          tone:"Typeskip",
          inputDescription: "World wide social media and marketplace",
          tagOne:"quality",
          tagTwo:"content",
          url: "www.swolepatrol.com/",
          headingOne: "Tired of protein powders that taste like chalk?",
          headingOneTwo: "Tired of protein powders that taste like chalk?",
            descriptionOne: "Finally, protein made the way it should be. With 26g of protein per serving and a mouth watering honey cinnamon peanut butter flavor, gains have never tasted this good.",
          descriptionTwo: "Swole Patrol is a new type of protein powder made for the hard-gaining athlete. It’s loaded with 26G of muscle building protein and has a delicious Honey Cinnamon Peanut Butter flavor. But what really sets Swole Patrol apart from other proteins is how it’s made. We use an advanced process to make our whey isolate, which means you get more pure protein per serving than any other brand on the market!"
          },
        {
          companyName:"Usemagicopy",
          tone:"Usemagicopy",
          inputDescription: "World wide social media and marketplace",
          tagOne:"Usemagicopy",
          tagTwo:"Content",
          url: "www.swolepatrol.com/",
          headingOne: "Tired of protein powders that taste like chalk?",
          headingOneTwo: "Two Tired of protein powders that taste like chalk?",
          descriptionOne: "Finally, protein made the way it should be. With 26g of protein per serving and a mouth watering honey cinnamon peanut butter flavor, gains have never tasted this good.",
          descriptionTwo: "Swole Patrol is a new type of protein powder made for the hard-gaining athlete. It’s loaded with 26G of muscle building protein and has a delicious Honey Cinnamon Peanut Butter flavor. But what really sets Swole Patrol apart from other proteins is how it’s made. We use an advanced process to make our whey isolate, which means you get more pure protein per serving than any other brand on the market!"
          },
      ]
    };
  },
  methods: {
    start_demo() {
      // Select a random no from content array
      let selectedContent = Math.floor((Math.random() * 3) + 1)

      this.tagOne = this.content[selectedContent].tagOne;
      this.tagTwo = this.content[selectedContent].tagTwo;
      this.company = this.content[selectedContent].companyName;
      this.title = this.content[selectedContent].tone;
      this.textarea = this.content[selectedContent].inputDescription;
      this.generatedContent = {
        url : this.content[selectedContent].url,
        heading : this.content[selectedContent].headingOne,
        headingTwo : this.content[selectedContent].headingOneTwo,
        descriptionOne : this.content[selectedContent].descriptionOne,
        descriptionTwo : this.content[selectedContent].descriptionTwo,
      }
      this.hitGenMessage = true;
    },
    makeShowRes() {
      if(this.textarea != null) {
        this.showRes = true;
        this.hitGenMessage = false;
      }

    },
  },
};
</script>

<style scoped>
.header_card_box_bg1 {
  background-image: url("../../../../../public/ts/images/banner/bnrg1.webp");
}
.header_card_box_bg2 {
  background-image: url("../../../../../public/ts/images/banner/bnrg2.webp");
}
</style>
