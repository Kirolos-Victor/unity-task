<template>

    <!-- Modal -->
    <div class="modal fade" id="PostCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input v-model="form.title" type="text" name="title" placeholder="title" class="form-control">
                    <div v-if="form.errors.has('title')" v-html="form.errors.get('title')" class="text-danger"/>

                    <input v-model="form.body" type="text" name="body" placeholder="body" class="form-control mt-2">
                    <div v-if="form.errors.has('body')" v-html="form.errors.get('body')" class="text-danger"/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="createPost()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "CreatePost",
    data()
    {
        return{
            form: new Form({
                title: '',
                body: ''
            })

        }
    },
    methods:{
        createPost()
        {
            this.form.post('api/posts').then(()=>{
                Fire.$emit('reloadPosts');
                Toast.fire({
                    icon: 'success',
                    title: 'Created successfully'
                });
                this.form.reset();
                $('#PostCreateModal').modal('hide');


            }).catch(()=>{
                Toast.fire({
                    icon:'error',
                    title:'failed'
                });
            });
        }
    }
}
</script>

<style scoped>

</style>
