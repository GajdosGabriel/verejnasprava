<template>
    <Card v-if="isModulActiveById">
        <card-header
            icon="task"
            :title="cardTitle"
            :isOpen="isOpen"
            @click.native="isOpen = !isOpen"
        />

        <div v-if="isOpen">
            <ul>
                <Task
                    v-for="task in sortedList"
                    :key="task.id"
                    :task="task"
                    @pushMarkAsCompleted="addOrRemoveTaskCompleted"
                ></Task>
            </ul>

            <div class="flex justify-between text-xs text-gray-500 px-2">
                <span
                    class="cursor-pointer hover:text-gray-800"
                    @click="showNewTask = !showNewTask"
                    >Nová požiadavka</span
                >
                <span
                    class="cursor-pointer hover:text-gray-800"
                    @click="changeTaskList"
                    v-text="nameOfList"
                    >vybavené</span
                >
            </div>

            <new-task v-if="showNewTask" :users="users" />
        </div>
    </Card>
</template>

<script>
import Card from "../components/Cards/Card.vue";
import cardHeader from "../components/Cards/CardHeader.vue";
import { createdMixin } from "../mixins/createdMixin";
import { mapState, mapActions, mapGetters } from "vuex";
import Task from "./Task";
import NewTask from "./NewTask";
import CardHeaderIcon from "../components/Cards/CardHeaderIcon";


export default {
    components: { Task, NewTask, CardHeaderIcon, cardHeader, Card },
    mixins: [createdMixin],
    data() {
        return {
            showNewTask: false,
            markAsCompleted: [],
        };
    },

    created() {
        this.$store.dispatch("tasks/getTasks", { root: true });
    },
    watch: {
        showCard() {
            this.markAsCompleted = [];
        },
    },

    computed: {
        ...mapState("tasks", ["setTaskList"]),
        ...mapState("organizations", ["users"]),
        ...mapGetters("organizations", ["menuActive"]),
        ...mapGetters("tasks", ["taskList"]),

        sortedList() {
            return _.orderBy(this.taskList, "due_date");
        },

        nameOfList() {
            return this.setTaskList ? "aktí­vne" : "vybavené";
        },

        isModulActiveById() {
            return this.$store.getters["organizations/menuActive"](6);
        },

        cardTitle(){
            return "Úlohy (" + this.taskList.length + ')'; 
        }
    },
    methods: {
        ...mapActions("tasks", ["variantTaskList"]),

        multiUpdateCompleted() {
            axios.put("/tasks/1", this.markAsCompleted).then((response) => {
                this.$store.dispatch("tasks/getTasks", { root: true });
            });

            this.markAsCompleted = [];
        },

        addOrRemoveTaskCompleted(task) {
            if (this.markAsCompleted.find((t) => t.id == task.id)) {
                return (this.markAsCompleted = this.markAsCompleted.filter(
                    (m) => {
                        return m.id !== task.id;
                    }
                ));
            }
            this.markAsCompleted.push(task);
        },

        changeTaskList() {
            this.variantTaskList(!this.setTaskList);
        },
    },
};
</script>
