<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="">
                    <!-- <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Categories</h1>
                            </div>
                            </div>
                        </div>
                        </section> -->
                        <section class="content">
                        <div class="alert alert-success" v-show="alert">The category has been saved.</div>
                        <div class="container-fluid">
                            <div class="row">
                            <div class="col-12">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Categories</h3>
                                    <div class="col-sm-12">
                                        <div class="float-sm-right">
                                            <router-link to="/addcategory" class="btn btn-light btn-sm">
                                                Add category
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(category,index) in categories" :key="category.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ category.category }} </td>
                                        <td class="d-flex">
                                            <router-link :to="`/editcategory/${category.id}`" class="btn btn-sm btn-light mr-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </router-link>
                                            <button type="submit" class="btn btn-sm btn-light" @click="deleteCategory(category.id)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                    </table>
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
    export default {
        name: 'categoryList',
        data() {
            return {
                categories:[],
                alert:false
            }
        },
        methods:{
            getcategories(){
                axios.get("api/categories")
                .then((resp)=>{
                    this.categories = resp.data
                    // console.log(this.categories);
                })
                .catch((errors)=>{
                    console.log(`something went wrong ` + errors);
                })
            },
            deleteCategory(id){
                axios.delete("/api/category/delete/"+id)
                .then((resp)=>{
                    // confirm("Are you sure ?")
                    console.log("category deleted");
                    this.getcategories()
                    this.alert = true
                })
                .catch((error)=>{
                    console.log(`There was an error ${error}`);
                })
            }
        },
        created(){
            console.log("work moron, work!");
            this.getcategories()
            console.log(this.categories)
        }
    }
</script>

<style scoped>
    
</style>