<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="">
                    <!-- <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Add Category</h1>
                            </div>
                            </div>
                        </div>
                        </section> -->
                        <!-- {{ $route.params.id }} -->
                    <section class="content">
                        <div class="container-fluid">
                        <div class="alert alert-success" v-show="alert">The category has been saved.</div>
                            <div class="row">
                            <div class="col-12">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Edit category</h3>
                                    <div class="col-sm-12">
                                        <div class="float-sm-right">
                                            <router-link to="/categories" class="btn btn-light btn-sm">
                                                categories
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="Updatecategory()">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <input type="text" class="form-control" :class="{'is-invalid':form.errors.has('category')}" placeholder="Enter category" @keydown="form.errors.clear()" v-model="form.category.category">
                                            <span class="invalid-feedback" v-show="form.errors.has('category')" v-text="form.errors.get('category')"></span>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-primary">save changes</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </section>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
    import {useRoute} from "vue-router"
    export default {
        name: 'editcategory',
        data() {
            return {
                form:new Form({
                    category:"",
                    id:""
                }),
                alert:false,
            }
        },
        methods:{
            Updatecategory(){
                let data = this.form.category;
                axios.put("/api/category/update/"+this.form.category.id,data)
                .then((response)=>{
                    this.alert = true,
                    this.form.errors.clear(),
                    this.category = response.data
                })
                .catch((error)=>{
                    this.form.errors.record(error.response.data)
                    console.log(`something went wrong. `+ error);
                })
                // alert(this.form.category.category)
            },
        },
        created(){
            let route = useRoute();
            let id = route.params.id;

            axios.get('/api/category/edit/'+id)
            .then((resp)=>{
                this.form.category = resp.data
                console.log(this.form.category);
            })
            .catch((err)=>{
                console.log("Failed to load category "+ err);
            });
        }
    }
</script>

<style scoped>
    .btn-light {
        color: #1F2D3D;
        background-color: #f8f9fa;
        border-color: #f8f9fa;
        box-shadow: none;
    }
    .btn{
        border-radius: 0px;
    }
</style>