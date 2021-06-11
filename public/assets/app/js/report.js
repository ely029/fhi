window.addEventListener('load', function() {

    let enrollmentTotalCase = document.getElementById('enrollment_total_case').value;
    let caseTotalCase = document.getElementById('case_total_case').value;
    let treatmentTotalCase = document.getElementById('treatment_total_case').value;
    new Chart('chartPresented', {
      type: 'pie',
      data: {
        labels: ['Enrollment', 'Case Management', 'Treatment Outcome'],
        datasets: [{
          data: [enrollmentTotalCase, caseTotalCase, treatmentTotalCase],
          backgroundColor: [
            'rgb(21, 98, 150)',
            'rgb(86, 151, 196)',
            'rgb(149, 198, 232)'
          ],
          hoverOffset: 4
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Reason for Presentation',
        },
        legend: {
          position: 'left',
          align: 'start',
          labels: {
            usePointStyle: true,
            point: 'circle'
          },
        }
      },
      plugins: {
        title: {
          align: 'start',
          display: true
        }
      }
    });
  });
  window.addEventListener('load', function() {
    let totalResolved = document.getElementById('total_resolved').value;
    let totalNotResolved = document.getElementById('total_not_resolved').value;
    new Chart('chartStatus', {
      type: 'pie',
      data: {
        labels: ['Resolved', 'Not Resolved'],
        datasets: [{
          data: [totalResolved, totalNotResolved],
          backgroundColor: [
            'rgb(209, 155, 63)',
            'rgb(237, 199, 105)'
          ],
          hoverOffset: 4
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Status',
        },
        legend: {
          position: 'left',
          align: 'start',
          labels: {
            usePointStyle: true,
            point: 'circle'
          },
        }
      }
    });
  });
  window.addEventListener('load', function() {
    let maleTotal = document.getElementById('male_total').value;
    let femaleTotal = document.getElementById('female_total').value;
    new Chart('chartSex', {
      type: 'pie',
      data: {
        labels: ['Male', 'Female'],
        datasets: [{
          data: [maleTotal, femaleTotal],
          backgroundColor: [
            'rgb(212, 101, 75)',
            'rgb(251, 159, 137)'
          ],
          hoverOffset: 4
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Sex',
        },
        legend: {
          position: 'left',
          align: 'start',
          labels: {
            usePointStyle: true,
            point: 'circle'
          },
        }
      }
    });
  });
  window.addEventListener('load', function() {
    let fourteenBelow = document.getElementById('14_below').value;
    let fifteenAbove = document.getElementById('15_above').value;
    new Chart('chartAge', {
      type: 'pie',
      data: {
        labels: ['0-14', '15 above'],
        datasets: [{
          data: [fourteenBelow, fifteenAbove],
          backgroundColor: [
            'rgb(85, 170, 121)',
            'rgb(159, 229, 189)'
          ],
          hoverOffset: 4
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Age',
        },
        legend: {
          position: 'left',
          align: 'start',
          labels: {
            usePointStyle: true,
            point: 'circle'
          },
        }
      }
    });
  });
  window.addEventListener('load', function() {
    new Chart('chartCasesPresented', {
      type: 'pie',
      data: {
        labels: ['Enrollment', 'Case Management', 'Treatment Outcome'],
        datasets: [{
          data: [300, 25, 53],
          backgroundColor: [
            'rgb(21, 98, 150)',
            'rgb(86, 151, 196)',
            'rgb(149, 198, 232)'
          ],
          hoverOffset: 4,
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Presented to NT-B MAC',
        },
        legend: {
          position: 'left',
          align: 'start',
          labels: {
            usePointStyle: true,
            point: 'circle'
          },
        }
      }
    });
  });
  window.addEventListener('load', function() {
    new Chart('chartCasesStatus', {
      type: 'pie',
      data: {
        labels: ['Resolved by NT-B MAC', 'Not Resolved by NT-B MAC'],
        datasets: [{
          data: [300, 25],
          backgroundColor: [
            'rgb(209, 155, 63)',
            'rgb(237, 199, 105)'
          ],
          hoverOffset: 4
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Status',
        },
        legend: {
          position: 'left',
          align: 'start',
          labels: {
            usePointStyle: true,
            point: 'circle'
          },
        }
      }
    });
  });

// for NTBMAC presentation

window.addEventListener('load', function() {

  let enrollmentTotalCase = document.getElementById('ntb_enrollment_total_case').value;
  let caseTotalCase = document.getElementById('ntb_case_total_case').value;
  let treatmentTotalCase = document.getElementById('ntb_treatment_total_case').value;
  new Chart('chartPresentedNTB', {
    type: 'pie',
    data: {
      labels: ['Enrollment', 'Case Management', 'Treatment Outcome'],
      datasets: [{
        data: [enrollmentTotalCase, caseTotalCase, treatmentTotalCase],
        backgroundColor: [
          'rgb(21, 98, 150)',
          'rgb(86, 151, 196)',
          'rgb(149, 198, 232)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Reason for Presentation',
      },
      legend: {
        position: 'left',
        align: 'start',
        labels: {
          usePointStyle: true,
          point: 'circle'
        },
      }
    },
    plugins: {
      title: {
        align: 'start',
        display: true
      }
    }
  });
});


window.addEventListener('load', function() {
  let totalResolved = document.getElementById('ntb_total_resolved').value;
  let totalNotResolved = document.getElementById('ntb_total_not_resolved').value;
  new Chart('chartStatusNTB', {
    type: 'pie',
    data: {
      labels: ['Resolved', 'Not Resolved'],
      datasets: [{
        data: [totalResolved, totalNotResolved],
        backgroundColor: [
          'rgb(209, 155, 63)',
          'rgb(237, 199, 105)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Status',
      },
      legend: {
        position: 'left',
        align: 'start',
        labels: {
          usePointStyle: true,
          point: 'circle'
        },
      }
    }
  });
});