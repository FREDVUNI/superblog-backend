<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
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
                        <div class="alert alert-danger" v-show="alertdanger">The image size is invalid.</div>
                            <div class="row">
                            <div class="col-12">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add Post</h3>
                                    <div class="col-sm-12">
                                        <div class="float-sm-right">
                                            <router-link to="/posts" class="btn btn-light btn-sm">
                                                Posts
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                   <form @submit.prevent="Addpost" enctype="multipart/form-data">
                                       <div class="form-group">
                                           <label for="title">Title</label>
                                           <input type="text" class="form-control" :class="{'is-invalid':form.errors.has('title')}" @keydown="form.errors.clear('title')" v-model="form.title" placeholder="Enter post title">
                                           <span class="text-danger" v-show="form.errors.has('title')" v-text="form.errors.get('title')"></span>
                                       </div>
                                       <div class="form-group">
                                           <label for="category">Category</label>
                                           <select class="form-control" v-model="form.category_id" :class="{'is-invalid':form.errors.has('category_id')}">
                                               <option value="" disabled>choose a category</option>
                                               <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category }}</option>
                                           </select>
                                           <span class="text-danger" v-show="form.errors.has('category_id')" v-text="form.errors.get('category_id')"></span>
                                       </div>
                                       <div class="form-group">
                                           <label for="description">Description</label>
                                           <textarea class="form-control" cols="30" placeholder="Enter post description" @keydown="form.errors.clear('description')" v-model="form.description" :class="{'is-invalid':form.errors.has('description')}"></textarea>
                                           <span class="text-danger" v-show="form.errors.has('description')" v-text="form.errors.get('description')"></span>
                                       </div>
                                       <div class="form-group">
                                            <label for="image">Photo</label>
                                            <br>
                                            <input type="file" @change="changePhoto($event)" ref="image" :class="{'is-invalid':form.errors.has('image')}" accept="image/*">
                                            <span class="text-danger" v-show="form.errors.has('image')" v-text="form.errors.get('image')"></span>
                                        </div>
                                        <div class="widget-post-image" v-if="imgPreview">
                                            <img :src="imgPreview" alt="photo" class="photo-post-img img-fluid">
                                        </div>
                                       <div class="form-group mt-2">
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
    export default {
        name: 'Add',
        data() {
            return {
                alert:false,
                alertdanger:false,
                categories:[],
                form:new Form({
                    title:"",
                    description:"",
                    category_id:"",
                    image:"" 
                })
            }
        },
        methods:{
            changePhoto(event){
                let file = event.target.files[0];
                if(file.size >1048576){
                    this.alertdanger = true
                }else{
                    let reader = new FileReader();

                    reader.onload = event =>{
                        this.form.image = event.target.result
                        console.log(event.target.result);

                    };
                    reader.readAsDataURL(file);
                }
            },
            Addpost(){
                let data = new FormData();
                data.append("title",this.form.title)
                data.append("description",this.form.description)
                data.append("category_id",this.form.category_id)
                data.append("image",this.form.image)

                axios.post("api/post/add",data)
                .then((response)=>{
                    this.form.category_id = "",
                    this.form.title = "",
                    this.form.description = "",
                    this.form.refs.image = "",
                    this.imgPreview="./images/noimage.png",
                    this.form.errors.clear(),
                    this.alert=true
                })
                .catch((error)=>{
                    this.form.errors.record(error.response.data)
                    console.log(`something went wrong ${error}`);
                })
            }
        },
        created(){
            axios.get("api/categories")
            .then((resp)=>{
                this.categories = resp.data
            })
            .catch((error)=>{
                console.log(`something went wrong ${error}`);
            }),
            this.imgPreview
        },
        computed:{
            imgPreview(){
                return this.form.image == "" ? "./images/noimage.png":this.form.image
            },
        }
    }
</script>

<style scoped>
    .photo-post-img {
        border: 2px solid steelblue;
        margin: 0 auto;
        padding: 3px;
        width: 100px;
    }
</style>