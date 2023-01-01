

// width and height in pixels
width: 280,
height: 280,
 
// z-inde property
zIndex: 1,
 
// selector or element
trigger: null,
 
// off
offset: [0, 1],

// custom CSS class
customClass: '',
 
// date or month
view: 'date',
 
// current date 
date: new Date(),
 
// date format
format: 'yyyy/mm/dd',
 
// start of week
startWeek: 0,
 
// day of the week
weekArray: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
// month
monthArray: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],

// date range
// [new Date(), null] or ['2015/11/23']
selectedRang: null

// custom event
data: null
// shows label
// {m} view mode，{d}date，{v}valu
// false = disabl
label: '{d}\n{v}'

// next / prev sign
prev: '&lt;',

next: '&gt;',
// callbacks
viewChange: $.noop,

onSelected: function(view, date, value) {},

onMouseenter: $.noop,

onClose: $.n

