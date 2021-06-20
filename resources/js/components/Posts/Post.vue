<template>
    <div class="container">
        <h1>Posts</h1>
        <button class="btn btn-success mt-2 mb-2" @click.prevent="showCreatePost()">Create</button>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Body</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(post,index) in posts">
                <th scope="row">{{ index+1 }}</th>
                <td>{{ post.title }}</td>
                <td>{{ post.body }}</td>
                <td><button class="btn btn-primary" @click.prevent="$refs.updatePost.showUpdatePost(post)">Update</button>
                    <button class="btn btn-danger" @click.prevent="postDelete(post.id)">Delete</button>
                </td>
            </tr>

            </tbody>
        </table>
        <create-post></create-post>
        <update-post ref="updatePost"></update-post>
    </div>
</template>

<script>
import CreatePost from "./CreatePost";
import UpdatePost from "./UpdatePost";

export default {
    name: "Post",
    components: {UpdatePost, CreatePost},
    data()
    {
        return{
            posts:{},


        }
    },
    methods:{
        loadPosts(){
            axios.get('api/posts').then(({data})=>{
                this.posts=data.data;
            })

        },
        showCreatePost(){
            $('#PostCreateModal').modal('show');

        },

        postDelete(id){
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    axios.delete('api/posts/'+id).then(()=>{
                        Fire.$emit('reloadPosts');
                        swal.fire(
                            'Deleted!',
                            'Your record has been deleted.',
                            'success'
                        );
                    }).catch(()=>{
                        swal.fire(
                            'Fail!',
                            'Something is wrong.',
                            'error'
                        );
                    });

                }
            });
        },

    },
    created() {
        this.loadPosts();
        Fire.$on('reloadPosts',()=>{
            this.loadPosts();
        })
    }
}
</script>

<style scoped>

</style>
