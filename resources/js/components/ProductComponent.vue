
<template>

    <div class="container">

        <h1 class="text-center">Product Manager</h1>
        <hr />

        <table class="table table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Stock</th>
                    <th scope="col" colspan="2" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="p in products" :key="p.id">
                    <td scope="row">{{ p.id }}</td>
                    <td>{{ p.name }}</td>
                    <td>{{ p.description }}</td>
                    <td>{{ p.stock }}</td>
                    <td>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

</template>

<script>
    export default {
        data(){
            return {
                products: [],
                product: {
                    id: 0,
                    name: '',
                    description: '',
                    stock: 0
                },
                pagination: {},
                current_page: '',
                modal_title: '',
                modal: 0,
                modify: false
            }
        },
        methods: {
            async list(page_url){
                let vm = this
                page_url = page_url || 'products'
                this.current
                const res = await axios.get('api/'+page_url)
                    .then(res => {
                        this.products = res.data.data
                        vm.makePagination(res.data)
                    })
                    .catch(err => console.log(err))
            },
            makePagination(meta){
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: meta.next_page_url,
                    prev_page_url: meta.prev_page_url
                }
                this.pagination = pagination
            }
        },
        created(){
            this.list()
        }
    }
</script>
