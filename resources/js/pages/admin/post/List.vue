<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="">
                    <!-- <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>posts</h1>
                            </div>
                            </div>
                        </div>
                        </section> -->
                        <section class="content">
                        <div class="container-fluid">
                        <div class="alert alert-success" v-show="alert">The post has been saved.</div>
                            <div class="row">
                            <div class="col-12">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Posts</h3>
                                    <div class="col-sm-12">
                                        <div class="float-sm-right">
                                            <router-link to="/addpost" class="btn btn-light btn-sm">
                                                Add post
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>user</th>
                                        <th>post</th>
                                        <th>category</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(post,index) in posts" :key="post.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ post.user.name }}</td>
                                        <td>{{ post.title }} </td>
                                        <td>{{ post.category.category }} </td>
                                        <td class="d-flex">
                                            <router-link :to="`/editpost/${post.id}`" class="btn btn-sm btn-light mr-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </router-link>
                                            <button type="submit" class="btn btn-sm btn-light" @click="deletepost(post.id)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>user</th>
                                        <th>post</th>
                                        <th>category</th>
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
        name: 'postList',
        data() {
            return {
                posts:[],
                alert:false
            }
        },
        methods:{
            getposts(){
                axios.get("api/posts")
                .then((resp)=>{
                    this.posts = resp.data
                    console.log(this.posts);
                })
                .catch((errors)=>{
                    console.log(`something went wrong ` + errors);
                })
            },
            deletepost(id){
                axios.delete("/api/post/delete/"+id)
                .then((resp)=>{
                    // confirm("Are you sure ?")
                    console.log("post deleted");
                    this.getposts()
                    this.alert = true
                })
                .catch((error)=>{
                    console.log(`There was an error ${error}`);
                })
            },
            getImage(img){
                return "./uploads/posts/"+img
            }
        },
        created(){
            console.log("work moron, work!");
            this.getposts()
            console.log(this.posts)
        }
    }
</script>

<style scoped>
    
</style>