<template>
<div class="container">
    <div class="row">
        <div style="width: 45rem;">
            <h1>Create post</h1>
            <form @submit.prevent="createPosts">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" v-model="post.title" />
                </div>
                <div class="form-group">
                    <label for="description">Content</label>
                    <textarea rows="5" class="form-control" v-model="post.postcontent"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="add todo" v-if="add">
                        Create
                    </button>
                    <button type="submit" class="btn btn-primary" value="add todo" v-else>
                        Update
                    </button>
                </div>
            </form>
            <div v-if="show">
                <form>
                    <div class="form-group">
                        <textarea class="form-control rounded-0" rows="1" type="text" name="comment" v-model="comment.commentcontent"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add comment</button>
                </form>
            </div>

            </nav>
        </div>
        <div class="card" style="width: 23rem;">
            <div class="card-body" v-for="post in posts">
                <h5 class="card-title" style="color:red">{{ post.title }}</h5>
                <p class="card-text">{{ post.postcontent }}</p>
                <div v-for="comment in post.comments">
                    <p class="card-text">{{ comment.commentcontent }}</p>
                </div>
                {{post.id}}
                <CreateComment :id="post.id" @commentResponse="comment_success" />
                <br>
                <button type="button" class="btn btn-info " style="width:100px;" @click="editPosts(post)">Edit</button>
                <button type="button" class="btn btn-danger " style="width:100px;" @click="deletePosts(post.id)">Delete</button>
            </div>
        </div>
    </div>
</div>
</div>
</template>

<style>
.form-control {
    display: block;
    width: 55%;
    height: calc(1.6em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
</style>

<script>
import CreateComment from './CreateComment';
export default {
    props: [
        'user',
    ],
    components: {
        CreateComment
    },
    data() {
        return {
            posts: [],
            post: {
                id: '',
                title: '',
                postcontent: '',
                comments: []
            },
            index:0,
            add: true,
            show: false,
            comments: [],
            comment: {
                commentcontent: ''
            }
        }
    },
    created() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            axios
                .get('/api/getposts')
                .then(response => {
                    this.posts = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
        },
        createPosts() {
            if (this.add) {
                axios.post('./api/createpost', {
                        user_id: JSON.parse(this.user).id,
                        title: this.post.title,
                        postcontent: this.post.postcontent
                    })
                    .then(response => {
                        this.post = response;
                        alert('Successfully Added');
                        this.getPosts();
                    })
                    .catch(e => {
                        console.log(e);
                    })
            } else {
                axios.post('./api/updatePost', {
                        id: this.post.id,
                        title: this.post.title,
                        postcontent: this.post.postcontent
                    })
                    .then(response => {
                        this.post = response;
                        // alert('Successfully Updated');
                        this.add = true;

                    })
                    .catch(e => {
                        console.log(e);
                    })
            }
        },
        deletePosts(id) {
            axios.get(`api/deletePost/${id}`, {
                    method: 'delete'
                })
                .then(response => {
                    this.posts = response.data;
                    alert('Successfully Deleted');
                    this.getPosts();

                })
                .catch(e => {
                    console.log(e);
                })
        },
        editPosts(post) {
            this.add = false;
            this.post = post;
        },
        getComments() {
            axios
                .get('./api/getcomments')
                .then(response => {
                    this.comments = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
        },
        comment_success(comment) {
            this.posts.filter(post => {
                if (post.id == comment.postId) {
                    post.comments.push(comment);
                }
            })
        },

    },
}
</script>
