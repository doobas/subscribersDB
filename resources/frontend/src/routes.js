import SubscriberList from './components/SubscriberList'
import FieldList from './components/FieldList'


export default [
  { path: '/', redirect: '/subscribers' },
  { path: '/subscribers', component: SubscriberList },
  { path: '/fields', component: FieldList },
]