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
                    <form id="newSchedule" method="POST" action="schedules/store">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Professor</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="text" name="professor"
                                            >
                                    </div>
                                    <p class="help is-danger">
                                        This field is required
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Course / Subject</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="text" name="course"
                                            >
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
                                        <textarea class="textarea" placeholder="Description" name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Laboratory</label>
                            </div>
                            <div class="field-body">
                                <div class="field is-narrow">
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                          <select name="lab">
                                            <option v-for="calendar in calendars" v-bind:value="calendar.id">
                                              {{ calendar.labName }}
                                            </option> 
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
                                        <input class="input" type="datetime-local" placeholder="Start Date" name="start">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control is-expanded has-icons-left ">
                                        <input class="input" type="datetime-local" placeholder="End Date" name="end"
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
                                            <input type="checkbox" name="isAllDay" id="allday" value="1">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal" id="reccuring_toggle">
                            <div class="field-label">
                                <label class="label">Recurring?(weekly)</label>
                            </div>
                            <div class="field-body">
                                <div class="field is-narrow">
                                    <div class="control">
                                        <label class="checkbox">
                                            <input type="checkbox" name="recurring" id="recurring" value="1">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="field is-horizontal" id="recurring_form" style="display:none">
                            <div class="field-label is-normal">
                                <label class="label">Week Days</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                  <div class="field-body">
                                      <div class="field">
                                          <div class="control">
                                              
                                          <label class="checkbox">
                                              <input type="checkbox" name="monday" id="monday" value="monday">
                                              Monday
                                          </label>
                                          <label class="checkbox">
                                              <input type="checkbox" name="tuesday" id="tuesday" value="tuesday">
                                              Tuesday
                                          </label>
                                          <label class="checkbox">
                                              <input type="checkbox" name="wednesday" id="wednesday" value="wednesday">
                                              Wednesday
                                          </label>
                                          <label class="checkbox">
                                              <input type="checkbox" name="thursday" id="thursday" value="thursday">
                                              Thursday
                                          </label>
                                          <label class="checkbox">
                                              <input type="checkbox" name="friday" id="friday" value="friday">
                                              Friday
                                          </label>
                                          <label class="checkbox">
                                              <input type="checkbox" name="saturday" id="saturday" value="saturday">
                                              Saturday
                                          </label>
                                          <label class="checkbox">
                                              <input type="checkbox" name="sunday" id="sunday" value="sunday">
                                              Sunday
                                          </label>

                                          </div>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal" id="recurring_form2" style="display:none">
                            <div class="field-label is-normal">
                                <label class="label">Repeat Until</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                  <div class="field-body">
                                      <div class="field">
                                          <div class="control">
                                              <input class="input" type="date" name="recurringEnd" 
                                                  >
                                          </div>
                                      </div>
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
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      schedules: [],// init schedules
      calendars: [], // init lab
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
      calendarList: [ //eto yung mga labs at color
        // {
        //   id: '0',
        //   name: 'Private',
        //   bgColor: '#9e5fff',
        //   borderColor: '#9e5fff'
        // },
        // {
        //   id: '1',
        //   name: 'Company',
        //   bgColor: '#00a9ff',
        //   borderColor: '#00a9ff'
        // }
      ],
      scheduleList: [ // eto yung mga sched ng calendar
       
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
        },
        //popup template

        titlePlaceholder: function() {
          return 'Profesor';
        },
        locationPlaceholder: function() {
          return 'Course / Subject';
        },
        startDatePlaceholder: function() {
          return 'Start date';
        },
        endDatePlaceholder: function() {
          return 'End date';
        },
        popupUpdate: function() {
          return 'Update';
        },
        popupDetailLocation: function(schedule) {
          return '<b>Course / Subject : </b>' + schedule.location;
        },
        popupDetailBody: function(schedule) {
          return '<b>Description :</b> ' + schedule.body;
        },
        popupEdit: function() {
          return 'Edit';
        },
        popupDetailState: function(schedule) {
           return ;
        },
        popupDelete: function() {
          return 'Delete';
        }

      },
      month: {
        startDayOfWeek: 0
      },
      week: {
        showTimezoneCollapseButton: false,
        timezonesCollapsed: false
      },
      taskView: true,
      scheduleView: true,
      useDetailPopup: true,
      disableDblClick: false,
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

    loadLaboratories() { // dito ko kinukuha mga data from database tapos iloop lahat ng data from api
     axios.get('/api/laboratories')
     .then((response) => {
       this.calendars = response.data;

      var i;
      for (i = 0; i < this.calendars.length; i++) {   
        let laboratory = this.calendars[i];

      console.log(laboratory.labName);

        this.calendarList.push({ 
            id: laboratory.id,
            name: laboratory.labName,
            bgColor: laboratory.color,
            borderColor: '#000000'
            })
        }
     })

    },

    loadSchedules() { // dito ko kinukuha mga data from database tapos iloop lahat ng data from api
     axios.get('/api/schedules')
     .then((response) => {
       this.schedules = response.data;
    
    var i;
    for (i = 0; i < this.schedules.length; i++) {   
      let schedule = this.schedules[i];

     console.log(schedule.professor);

      this.scheduleList.push({ 

          id: schedule.id,
          calendarId: schedule.labID,
          title: schedule.professor,
          body: schedule.description,
          location: schedule.course,
          category: 'time',
          isAllDay: schedule.isAllDay,
          raw: schedule.reccuringID,
          start: new Date(schedule.start).toISOString(),
          end: new Date(schedule.end).toISOString()

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
      let uri = `/api/schedules/${res.schedule.raw}`;
      axios.delete(uri).then(response => {
      // const idx = this.scheduleList.findIndex(item => item.id === res.schedule.id);
      console.group('onBeforeDeleteSchedule');
      console.log('Schedule Infos : ', res.schedule);
      console.groupEnd(); 
      // this.scheduleList.splice(idx, 1);
      window.location.reload();
      });          
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
    this.loadLaboratories();
    this.loadSchedules();
  }
};
</script>
<style>
</style>