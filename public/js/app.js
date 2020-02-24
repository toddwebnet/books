$(document).ready(function () {

})

function loadTopBooks () {
  $('#mainContainer').html('Loading...')
  $.ajax({
    url: '/ajax/topBooks',
    type: 'GET',
    cache: false,
  }).done(function (data) {
    $('#mainContainer').html(data)
  })
}

function showBook (bookId) {
  $('#mainContainer').html('Loading...')
  $.ajax({
    url: '/ajax/showBook/' + bookId,
    type: 'GET',
    cache: false,
  }).done(function (data) {
    $('#mainContainer').html(data)
  })
}

function deleteSale (saleId) {
  if (confirm('Are you sure?\n bad things might happen')) {
    $('#mainContainer').html('Loading...')
    $.ajax({
      url: '/ajax/deleteSale/' + saleId,
      type: 'GET',
      cache: false,
    }).done(function (data) {
      $('#mainContainer').html(data)
    })
  }
}

function purchaseBook (editionId) {

  // crude form validation
  if (
    document.getElementById('firstName').value.trim() == '' ||
    document.getElementById('lastName').value.trim() == ''
  ) {
    alert('Please Enter Your Name First.')
    return
  }

  // do the post

  dataPacket = $('#thisFineForm').serialize()
  $('#mainContainer').html('Loading...')
  $.ajax({
    url: '/ajax/purchaseBook/' + editionId,
    type: 'POST',
    data: dataPacket,
    cache: false,
  }).done(function (data) {
    $('#mainContainer').html(data)
  })
}

function editBook (bookId) {
  $('#mainContainer').html('Loading...')
  $.ajax({
    url: '/ajax/editBook/' + bookId,
    type: 'GET',
    cache: false,
  }).done(function (data) {
    $('#mainContainer').html(data)
  })

}

function deleteBook (bookId) {
  if (confirm('Are you sure?\n bad things might happen')) {
    $('#mainContainer').html('Loading...')
    $.ajax({
      url: '/ajax/deleteBook/' + bookId,
      type: 'GET',
      cache: false,
    }).done(function (data) {
      $('#mainContainer').html(data)
    })
  }

}

function checkSaveBookForm () {
  errs = []
  fields = [
    'first_name', 'last_name',
    'title', 'description', 'copyright'
  ]
  for (x = 0; x < fields.length; x++) {
    if ($('#' + fields[x]).val().trim() == '') {
      errs.push('Field ' + fields[x] + ' is empty')
    }
  }

  if (errs.length > 0) {
    alert(errs.join('\n\n'))
    return false
  } else {
    return true
  }

}

function saveBook () {
  if (checkSaveBookForm()) {
    dataPacket = $('#bookForm').serialize()
    $('#mainContainer').html('Loading...')
    $.ajax({
      url: '/ajax/saveBook',
      type: 'POST',
      data: dataPacket,
      cache: false,
    }).done(function (data) {
      $('#mainContainer').html(data)
    })
  }
  return false
}
