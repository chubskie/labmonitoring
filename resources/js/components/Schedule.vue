<template>
<div>
<div class="box level">
<span class="level-left">
<div class="select is-rounded is-small level-item">
<select class="has-text-weight-semibold " v-model="selectedView">
<option v-for="(options, index) in viewModeOptions" :value="options.value" :key="index">
{{options.title}}
</option>
</select>
</div>
<span @click="onClickNavi($event)" class="level-item">
<button type="button" class="button is-rounded has-text-weight-semibold is-small is-info mr-1"
data-action="move-today">Today</button>
<button type="button" class="button is-rounded has-text-weight-semibold is-small mr-1"
data-action="move-prev">Prev</button>
<button type="button" class="button is-rounded has-text-weight-semibold is-small"
data-action="move-next">Next</button>
</span>
<span class="render-range tag is-medium level-item has-text-weight-semibold">{{dateRange}}</span>
</span>

<span class="level-right">
<button id="newsched" type="button"
class="button is-rounded has-text-weight-semibold is-small is-info is-light level-item is-link">New
Schedule</button>
</span>
</div>

<div id="add-card-new-sched" class="card" style="display:none">
<header class="card-header">
<p class="card-header-title">
New Schedule Form
</p>
</header>
<div class="card-content">
<div class="content">
<form id="newSchedule">
<div class="field is-horizontal">
<div class="field-label is-normal">
<label class="label">Title</label>
</div>
<div class="field-body">
<div class="field">
<div class="control">
<input class="input" type="text"
placeholder="e.g. Prof's Name">
</div>
<p class="help is-danger">
This field is required
</p>
</div>
</div>
</div>

<div class="field is-horizontal">
<div class="field-label is-normal">
<label class="label">Description</label>
</div>
<div class="field-body">
<div class="field">
<div class="control">
<textarea class="textarea" placeholder="Description"></textarea>
</div>
</div>
</div>
</div>

<div class="field is-horizontal">
<div class="field-label is-normal">
<label class="label">Category</label>
</div>
<div class="field-body">
<div class="field is-narrow">
<div class="control">
<div class="select is-fullwidth">
<select>
<option>Category 1</option>
<option>Category 2</option>
</select>
</div>
</div>
</div>
</div>
</div>

<div class="field is-horizontal">
<div class="field-label is-normal">
<label class="label">Date</label>
</div>
<div class="field-body">
<div class="field">
<p class="control is-expanded has-icons-left">
<input class="input" type="datetime-local" placeholder="Start Date">
<span class="icon is-small is-left">
<i class="fas fa-calendar"></i>
</span>
</p>
</div>
<div class="field">
<p class="control is-expanded has-icons-left ">
<input class="input" type="datetime-local" placeholder="End Date"
>
<span class="icon is-small is-left">
<i class="fas fa-calendar"></i>
</span>
</p>
</div>
</div>
</div>

<div class="field is-horizontal">
<div class="field-label">
<label class="label">All day?</label>
</div>
<div class="field-body">
<div class="field is-narrow">
<div class="control">
<label class="checkbox">
<input type="checkbox" name="allday">
Yes
</label>
</div>
</div>
</div>
</div>

<div class="buttons is-centered">
<button type="submit" class="button is-success">Submit</button>
<button class="button is-danger is-outlined cancel" type="button">Cancel</button>
</div>
</form>
</div>
</div>
</div>
<br>

<calendar style="height: 800px"
ref="tuiCal"
:useDetailPopup="useDetailPopup"
:view="selectedView"
:calendars="calendarList"
:schedules="scheduleList"
:theme="theme"
:template="template"
:taskView="false"
:scheduleView="true"
:month="month"
:week="week"
:disableDblClick="disableDblClick"
:isReadOnly="isReadOnly"
@clickSchedule="onClickSchedule"
@clickDayname="onClickDayname"
@beforeDeleteSchedule="onBeforeDeleteSchedule"
@afterRenderSchedule="onAfterRenderSchedule"
@clickTimezonesCollapseBtn="onClickTimezonesCollapseBtn"
/>

</div>
</template>
<script>
import axios from 'axios'
import 'tui-time-picker/dist/tui-time-picker.css';
import 'tui-date-picker/dist/tui-date-picker.css';
import 'tui-calendar/dist/tui-calendar.css';
import './app.css';

import {Calendar} from './index';
import myTheme from './myTheme';

const today = new Date();
const getDate = (type, start, value, operator) => {
start = new Date(start);
type = type.charAt(0).toUpperCase() + type.slice(1);

if (operator === '+') {
start[`set${type}`](start[`get${type}`]() + value);
} else {
start[`set${type}`](start[`get${type}`]() - value);
}

return start;
};

export default {
name: 'App',
components: {
'calendar': Calendar
},
data() {
return {
schedules: [],
viewModeOptions: [
{
title: 'Monthly',
value: 'month'
},
{
title: 'Weekly',
value: 'week'
},
{
title: 'Daily',
value: 'day'
}
],
dateRange: '',
selectedView: 'week',
// calendarList: [
//   {
//     id: '0',
//     name: 'Private',
//     bgColor: '#9e5fff',
//     borderColor: '#9e5fff'
//   },
//   {
//     id: '1',
//     name: 'Company',
//     bgColor: '#00a9ff',
//     borderColor: '#00a9ff'
//   }
// ],
scheduleList: [
//  {
// id: '1',
// calendarId: '1',
// title: 'my schedule',
// category: 'time',
// dueDateClass: '',
// start: '2020-11-13T07:31:54.329Z',
// end: '2020-11-14T07:31:54.329Z'
// },
// {
//   id: '1',
//   calendarId: '0',
//   title: schedules[0].title,
//   category: 'time',
//   dueDateClass: '',
//   start: today.toISOString(),
//   end: getDate('hours', today, 3, '+').toISOString()
// },
// {
//   id: '11',
//   calendarId: '0',
//   title: 'Test',
//   category: 'time',
//   dueDateClass: '',
//   start: today.toISOString(),
//   end: getDate('hours', today, 3, '+').toISOString()
// },
// {
//   id: '2',
//   calendarId: '1',
//   title: 'Marjon',
//   category: 'milestone',
//   dueDateClass: '',
//   start: getDate('date', today, 1, '+').toISOString(),
//   end: getDate('date', today, 1, '+').toISOString(),
//   isReadOnly: true
// },
// {
//   id: '3',
//   calendarId: '1',
//   title: 'Ramos',
//   category: 'allday',
//   dueDateClass: '',
//   start: getDate('date', today, 2, '-').toISOString(),
//   end: getDate('date', today, 1, '-').toISOString(),
//   isReadOnly: true
// },
// {
//   id: '4',
//   calendarId: '1',
//   title: 'Report',
//   category: 'time',
//   dueDateClass: '',
//   start: today.toISOString(),
//   end: getDate('hours', today, 1, '+').toISOString()
// }
],

theme: myTheme,
template: {
milestone(schedule) {
return `<span style="color:#fff;background-color: ${schedule.bgColor};">${schedule.title}</span>`;
},
milestoneTitle() {
return 'Milestone';
},
allday(schedule) {
return `${schedule.title}<i class="fa fa-refresh"></i>`;
},
alldayTitle() {
return 'All Day';
}
},
month: {
startDayOfWeek: 0
},
week: {
showTimezoneCollapseButton: true,
timezonesCollapsed: true
},
taskView: true,
scheduleView: true,
useDetailPopup: true,
disableDblClick: true,
isReadOnly: false
};
},
watch: {
selectedView(newValue) {
this.$refs.tuiCal.invoke('changeView', newValue, true);
this.setRenderRangeText();
}
},
methods: {
init() {
this.setRenderRangeText();
},
loadSchedules() {
axios.get('/api/schedules')
.then((response) => {
this.schedules = response.data;

var i;
for (i = 0; i < this.schedules.length; i++) {   
let schedule = this.schedules[i];

this.scheduleList.push({
id: schedule.id,
title: schedule.title,
category: schedule.category,
bgColor: '#f54242',
start: schedule.start,
end: schedule.end
})
}

})
},
setRenderRangeText() {
const {invoke} = this.$refs.tuiCal;
const view = invoke('getViewName');
const calDate = invoke('getDate');
const rangeStart = invoke('getDateRangeStart');
const rangeEnd = invoke('getDateRangeEnd');
let year = calDate.getFullYear();
let month = calDate.getMonth() + 1;
let date = calDate.getDate();
let dateRangeText = '';
let endMonth, endDate, start, end;

switch (view) {
case 'month':
dateRangeText = `${year}-${month}`;
break;
case 'week':
year = rangeStart.getFullYear();
month = rangeStart.getMonth() + 1;
date = rangeStart.getDate();
endMonth = rangeEnd.getMonth() + 1;
endDate = rangeEnd.getDate();

start = `${year}-${month}-${date}`;
end = `${endMonth}-${endDate}`;
dateRangeText = `${start} ~ ${end}`;
break;
default:
dateRangeText = `${year}-${month}-${date}`;
}
this.dateRange = dateRangeText;
},
onClickNavi(event) {
if (event.target.tagName === 'BUTTON') {
const {target} = event;
let action = target.dataset ? target.dataset.action : target.getAttribute('data-action');
action = action.replace('move-', '');

this.$refs.tuiCal.invoke(action);
this.setRenderRangeText();
}
},
onClickSchedule(res) {
console.group('onClickSchedule');
console.log('MouseEvent : ', res.event);
console.log('Calendar Info : ', res.calendar);
console.log('Schedule Info : ', res.schedule);
console.groupEnd();
},
onClickDayname(res) {
// view : week, day
console.group('onClickDayname');
console.log(res.date);
console.groupEnd();
},
onBeforeDeleteSchedule(res) {
console.group('onBeforeDeleteSchedule');
console.log('Schedule Info : ', res.schedule);
console.groupEnd();

const idx = this.scheduleList.findIndex(item => item.id === res.schedule.id);
this.scheduleList.splice(idx, 1);
},
onAfterRenderSchedule(res) {
console.group('onAfterRenderSchedule');
console.log('Schedule Info : ', res.schedule);
console.groupEnd();
},
onClickTimezonesCollapseBtn(timezonesCollapsed) {
// view : week, day
console.group('onClickTimezonesCollapseBtn');
console.log('Is Collapsed Timezone? ', timezonesCollapsed);
console.groupEnd();

if (timezonesCollapsed) {
this.theme['week.timegridLeft.width'] = '100px';
this.theme['week.daygridLeft.width'] = '100px';
} else {
this.theme['week.timegridLeft.width'] = '50px';
this.theme['week.daygridLeft.width'] = '50px';
}
}
},
mounted() {
this.init();
this.loadSchedules();
}
};
</script>
<style>
</style>
