const { createApp } = Vue;
let products = [
    { name: 'product 1', price: 100 },
    { name: 'product 2', price: 200 },
    { name: 'product 3', price: 300 },
    { name: 'product 4', price: 400 }

];
let product = {
    props: [
        'name', 'price', 'index'
    ],
    template:
        `
    <div class="box">
        <h3>{{ name }}</h3>
        <p>{{ price }}$ - {{price * quantity}}$</p>
        <input type="number" min="1" v-model="quantity">
        <button @click="addToCard(index , quantity)">Add to Cart</button>
    </div>
    `,
    data() {
        return {
            quantity: 1
        }
    },
    methods: {
        addToCard(index, quantity) {
            this.$emit('add', index, quantity);
            this.quantity = 1;

        }
    },

}
let app = createApp({
    components: {
        product
    },
    data() {
        return {
            products,
            carts: []
        }
    },
    methods: {
        addItem(index, quantity) {
            if (this.carts.some(data => data.index === index)) {
                 this.carts[index].quantity += quantity ;
            } else {
                let item = {
                    index,
                    name: this.products[index].name,
                    price: this.products[index].price,
                    quantity
                }
                this.carts.push(item)
            }
        },
        deleteItem(cart) {
            this.carts.splice(cart, 1)
        }
    },
    computed: {
        getTotal() {
            let total = 0;
            this.carts.forEach(el => {
                total += el.price * el.quantity
            });
            return total;
        }
    }
}).mount('#app');