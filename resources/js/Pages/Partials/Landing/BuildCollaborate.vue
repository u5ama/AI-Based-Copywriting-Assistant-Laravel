<template>
  <div class="new-build-collaborate">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="col-lg-10 offset-lg-2">
            <div class="review-slider-area">
              <div class="slider-navigation">
                <div
                  class="slider-navigation"
                  :class="{ active: dataOne }"
                  @click="changeData('one')"
                ></div>
                <div
                  class="slider-navigation"
                  :class="{ active: dataTwo }"
                  @click="changeData('two')"
                ></div>
                <div
                  class="slider-navigation"
                  :class="{ active: dataThree }"
                  @click="changeData('three')"
                ></div>
              </div>
              <div class="slider-content">
                <div class="feedback-single" v-if="dataOne">
                  <div class="feedback-single-content">
                    <h3>
                      "I just wrote a full ebook in an hour. It's unbelievable
                      how good this is."
                    </h3>
                  </div>
                  <div class="feedback-provider">
                    <h5>Jesse S.</h5>
                    <h6>Marketer</h6>
                  </div>
                </div>
                <div class="feedback-single" v-if="dataTwo">
                  <div class="feedback-single-content">
                    <h3>
                      "Currently using it in my dropshipping business to upload and list products. I’m recommending it to everyone I know."
                    </h3>
                  </div>
                  <div class="feedback-provider">
                    <h5>Manny A.</h5>
                    <h6>Dropshipper</h6>
                  </div>
                </div>
                <div class="feedback-single" v-if="dataThree">
                  <div class="feedback-single-content">
                    <h3>
                      "Easily the best tool of 2021. It is a gamechanger!"
                    </h3>
                  </div>
                  <div class="feedback-provider">
                    <h5>Jenny P.</h5>
                    <h6>Agency</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/pagination";
import "./style.css";
import SwiperCore, { Mousewheel, Pagination } from "swiper";
SwiperCore.use([Mousewheel, Pagination]);

export default {
  name: "BuildCollaborate",
  components: {
    Swiper,
    SwiperSlide,
  },
  data() {
    return {
      dataOne: true,
      dataTwo: false,
      dataThree: false,
    };
  },
  methods: {
    changeData(data) {
      if (data == "one") {
        this.dataOne = true;
        this.dataTwo = false;
        this.dataThree = false;
      } else if (data == "two") {
        this.dataOne = false;
        this.dataTwo = true;
        this.dataThree = false;
      } else {
        this.dataOne = false;
        this.dataTwo = false;
        this.dataThree = true;
      }
    },
  },
};
</script>

<style scoped>
.new-build-collaborate {
  background: #03192e;
  min-height: 700px;
  margin-top: 100px;
}
.review-slider-area {
  display: flex;
  justify-content: flex-start;
}
.feedback-single-content h3 {
  font-weight: bold;
  color: #fff;
  margin-bottom: 30px;
  line-height: 1.5em;
}
.feedback-provider h5 {
  font-size: 20px;
  color: #fff;
  font-weight: bold;
  line-height: 1;
}
.feedback-provider h6 {
  font-size: 18px;
  color: #fff;
}
.slider-navigation {
  margin-right: 25px;
}
.slider-navigation .slider-navigation {
  height: 26px;
  width: 26px;
  border: 1px solid #ffaa48;
  border-radius: 50%;
  margin-top: 16px;
  cursor: pointer;
  transition: 0.8s all ease;
}
.slider-navigation .slider-navigation.active {
  height: 40px;
  width: 26px;
  border-radius: 26px;
  background: #ffaa48;
  box-shadow: 0 0 20px rgb(252 56 56 / 30%);
}
@media only screen and (max-width: 767px) {
    .review-slider-area {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column-reverse;
    text-align: center;
}
.slider-navigation {
  margin-right: 25px;
  display: flex;
  align-items: center;
}
.feedback-single-content h3 {
    font-size: 20px;
}


.slider-navigation .slider-navigation.active {
  height: 18px;
  width: 35px;
}
.slider-navigation .slider-navigation:last-child {
  margin-right: 0;
}
}
</style>
