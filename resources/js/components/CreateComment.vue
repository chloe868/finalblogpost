<template>
<div>
    <!-- Button trigger modal -->
    <button type="button" :postId="id" class="btn btn-primary showBtn" data-toggle="modal" data-target="#commentModal">
        Add comment 
    </button>

    <!-- Modal -->
    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">
                        Comment
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Comment:</label>
                        <textarea v-model="commentcontent" class="form-control" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" data-dismiss="modal" @click="createComments" @keypress.enter="createComments" class="btn btn-primary">
                        Save changes {{id}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ["id"],
    data() {
        return {
            commentcontent: ""

        }
    },
    methods: {
        createComments() {
            var _postId = $(".showBtn").attr("postId");            
            axios.post('api/createcomments', {
                    postId: Number(_postId),
                    user_id: Number(window.$user),
                    commentcontent: this.commentcontent
                })
                .then(response => {
                    this.$emit("commentResponse", response.data);

                })
                .catch(e => {
                    console.log(e);
                })
            this.commentcontent = "";

        },
    },
    mounted() {
        
    },
};
</script>
