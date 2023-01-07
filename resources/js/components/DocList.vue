<template>
    <div class="row">
        <div v-for="(tag , c_index) in laravelData.data" :key="tag.id" class="col-lg-3" >
            <a @click="pagedetail(tag.id)">
                <div class="sc-iWFSnp cmuvkJ d-flex align-items-center justify-content-center" style="height: 300px;">
                    <div class="sc-dRPiIx esbyIi">
                        <div class="docs-google mx-auto d-block">
                            <h4 class="d-flex justify-content-center" style=" font-weight: 600; text-align:center">
                                <img class="img-fluid" src="assets/admin/images/file.png"  alt="facebook.png" style="width:250px;">
                            </h4>
                            <h2 class="ml-2">{{tag.title}}</h2>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="card-body d-flex justify-content-center">
            <pagination :data="laravelData" @pagination-change-page="getResults"></pagination>
        </div>
    </div>
</template>
<script>

    export default {
        name: "DocList",
        data() {
            return {
                perPage: 3,
                currentPage: 1,
                items: [
                    { id: 1, first_name: 'Fred', last_name: 'Flintstone' },
                    { id: 2, first_name: 'Wilma', last_name: 'Flintstone' },
                    { id: 3, first_name: 'Barney', last_name: 'Rubble' },
                    { id: 4, first_name: 'Betty', last_name: 'Rubble' },
                    { id: 5, first_name: 'Pebbles', last_name: 'Flintstone' },
                    { id: 6, first_name: 'Bamm Bamm', last_name: 'Rubble' },
                    { id: 7, first_name: 'The Great', last_name: 'Gazzoo' },
                    { id: 8, first_name: 'Rockhead', last_name: 'Slate' },
                    { id: 9, first_name: 'Pearl', last_name: 'Slaghoople' }
                ],
                users: {},
                userdocdetial:{},
                laravelData: {},
            }
        },
        created() {
            this.getResults();
        },
    computed: {
        rows() {
            return this.items.length
        }
    },
        mounted() {
            console.log('Component mounted.');
            this.getUser();
        },
        methods: {
            getResults(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }

                this.$http.get('/show?page=' + page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                    this.laravelData = data;
                    console.log(this.laravelData,'eeeeeeeeeeeeeeee');
                });
            },
            pagedetail(id){
                axios.get('/affiliate/'+id)
                    .then((response)=>{
                        this.userdocdetial = response.data
                        window.location="/affiliate/" + id;
                    })
            },
            getUser() {
                axios.get('/show')
                    .then((response) => {
                        this.users = response.data
                        console.log(this.users, 'sumair jutt');
                    })
            },
        }
    }

</script>

<style scoped>
    .page-item.active .page-link{
        background-color: #fb8231 !important;
        border-color: #fb8231 !important;
    }
    .col-lg-3 {
        flex: 0 0 25% !important;
        max-width: 100% !important;
    }

</style>
