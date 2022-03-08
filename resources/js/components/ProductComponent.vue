
<template>

    <div class="container">

        <h1 class="text-center">Product Manager</h1>
        <hr />

        <div>
            <nav style="float: left;" aria-label="Page navigation example">
                <ul class="pagination">
                    <li v-bind:class="[{ disabled: !pagination.prev_page_url }]" class="page-item">
                        <a @click="list(pagination.prev_page_url)" class="page-link" href="#">Previous</a>
                    </li>
                    <li v-bind:class="[{ disabled: !pagination.next_page_url }]" class="page-item">
                        <a @click="list(pagination.next_page_url)" class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>

            <button style="float: right;"
                @click="modify=false;
                openModal();"
                type="button" class="btn btn-primary">new
            </button>
        </div>

        <!-- Modal -->
        <div class="modal" :class="{showDialog:modal}" id="modelId">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ modal_title }}</h5>
                            <button @click="closeModal();" type="button" class="btn-close" data-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="pname" class="form-control" placeholder="Product Name"
                            v-model="product.name"
                        >
                        <label for="description" class="p-top-10">Description:</label>
                        <textarea name="description" id="pdescription" class="form-control" rows="5"
                            v-model="product.description" placeholder="Product Description"
                        />
                        <label for="stock" class="p-top-10">stock:</label>
                        <input type="number" name="stock" id="pstock" class="form-control"
                            v-model="product.stock" placeholder="Product Stock"
                        >
                    </div>
                    <div class="modal-footer">
                        <button @click="closeModal()" type="button" class="btn btn-secondary">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <br>

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
                        <button @click="modify=true; openModal(p)"
                                class="btn btn-warning">Edit
                        </button>
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
                if(page_url==='all') page_url = 'api/products'
                this.current_page = page_url
                const res = await axios.get(page_url)
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
            },
            openModal(product){
                this.modal = 1
                if(this.modify){
                    this.modal_title = "Modify Product"
                    let prod = {
                        id: product.id,
                        name: product.name,
                        description: product.description,
                        stock: product.stock
                    }
                    this.product = prod
                } else {
                    this.modal_title = "New Product"
                    let modal_body = {
                        id: 0,
                        name: '',
                        description: '',
                        stock: 0
                    }
                    this.product = modal_body
                }
            },
            closeModal(){
                this.modal = 0
            }
        },
        created(){
            this.list('all')
        }
    }
</script>

<style>
    .showDialog{
        display: list-item;
        opacity: 1;
        background: rgba(153, 128, 128, 0.849);
    }
</style>
