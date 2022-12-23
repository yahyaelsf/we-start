<template>
<div>
    <Fullcalendar :options='calendarOptions'/>


    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ newEvent.user_name }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">{{ newEvent.event_name }} | Price : {{ newEvent.price }} | Day : {{ newEvent.day }}</div>
                <div class="modal-footer">
                    <button @click.prevent="Cancel" class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Fullcalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import timeGrid from "@fullcalendar/timeGrid";
export default {
    name: "Calendar",
    components: {
        Fullcalendar
    },
    data() {
        return {
            calendarOptions: {
                plugins: [
                    dayGridPlugin,
                    interactionPlugin, // needed for dateClick
                    timeGrid
                ],
                initialView: 'dayGridMonth',
                events: [],
                eventClick: this.showEvent,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
            },
            newEvent: {
                event_name: "",
                start_date: "",
                end_date: "",
                backgroundColor: "",
                user_name: "",
                price: "",
                day: "",
            },
            addingMode: true,
            indexToUpdate: "",
            errors: {},
            disabled: false,
        };

    },
    created() {
        this.getBooking();
    },
    methods: {
        Cancel(){
            $('#logoutModal').modal('hide');
        },
        showEvent(clickInfo) {
            this.errors = {};
            $('#logoutModal').modal('show');
            this.addingMode = false;
            axios.get(`/admin/appointment/${clickInfo.event.id}`)
                .then(res => {
                    console.log(res.data)
                    const {id, start, end, backgroundColor, user_name, villa_name, price, day} = this.calendarOptions.events.find(
                        event => event.id === +clickInfo.event.id
                    );
                    this.indexToUpdate = id;
                    this.newEvent = {
                        event_name: villa_name,
                        start_date: start,
                        end_date: end,
                        backgroundColor: backgroundColor,
                        user_name: user_name,
                        price: price,
                        day: day,

                    };
                })
                .catch(err =>
                    console.log("Unable to add new event!", err.response.data)
                );
        },
        getBooking() {
            axios.get("/admin/all-appointments").then(res => {
                console.log(res.data)
                this.calendarOptions.events = res.data.data
            }).catch(err => console.log(err.response.data));
        },
    },
}
</script>

<style scoped>

</style>
