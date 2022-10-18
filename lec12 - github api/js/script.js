Vue.createApp({
    data() {
        return {
            username: "yahyaelsf",
            name: "yahyaelsaftawi",
            image: '',
            repos: []
        }
    },
    methods: {
        searchData() {
            axios.get("https://api.github.com/users/" + this.username)
                .then(res => {
                    this.image = res.data.avatar_url;
                    this.name = res.data.name;
                    axios.get("https://api.github.com/users/"+this.username+"/repos")
                    .then(repo =>{
                        this.repos = repo.data;
                        arr= [];
                        this.repos.forEach(el => {
                            let item = {
                                name : el.name ,
                                url: el.html_url,
                            }
                            arr.push(item);
                        });
                        this.repos = arr ;
                        console.log(this.repos);
                    })
                });
        }
    }   
}).mount('#app');
