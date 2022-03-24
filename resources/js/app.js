
require('./bootstrap');
import {createApp} from 'vue'
import PRCreation from './components/pr_creation.vue'
import NameofRawMaterial from './components/raw_material.vue'
import LCBuyer from './components/lc_buyer.vue'
import Seller from './components/supplier.vue'
const app=createApp({});

app.component('pr-creation',PRCreation)
app.component('raw-material',NameofRawMaterial)
app.component('lc-buyer',LCBuyer);
app.component('seller',Seller);
app.mount('#app')

