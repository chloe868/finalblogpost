<template>
<div class="col-md-5 col-md-offset-2">
    <div class="card" style="width: 18rem;">
        <div class="card-body" v-for="post in posts">
            <h5 class="card-title" style="color:red">{{ post.title }}</h5>
            <p class="card-text">{{ post.postcontent }}</p>
            <button type="button" class="btn btn-info " style="width:100px;" @click="getPosts()">Edit</button>
            <button type="button" class="btn btn-danger " style="width:100px;" @click="getPosts()">Update</button>
        </div>
    </div>
</div>
</template>
