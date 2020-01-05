import SubscriberList from './components/SubscriberList'
import SubscriberForm from './components/SubscriberForm'
import FieldList from './components/FieldList'
import FieldsForm from './components/FieldsForm'


export default [
  { path: '/', redirect: '/subscribers' },
  { path: '/subscribers', component: SubscriberList },
  { path: '/subscribers/create', component: SubscriberForm },
  { path: '/subscribers/edit/:id', component: SubscriberForm },
  { path: '/fields', component: FieldList },
  { path: '/fields/create', component: FieldsForm, name: 'createField' },
  { path: '/fields/edit/:id', component: FieldsForm, name: 'editField'},
]