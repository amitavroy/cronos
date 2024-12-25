// src/utils/formatDate.js
export function formatDateToBrowserTimezone(dateString) {
  if (!dateString) return null

  try {
    // Parse the date string
    const date = new Date(dateString)

    // Get the user's timezone from the browser
    const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone

    // Format the date
    const options = {
      year: 'numeric',
      month: '2-digit',
      day: '2-digit',
      hour: '2-digit',
      minute: '2-digit',
      hour12: false,
      timeZone: userTimezone,
    }

    const formatter = new Intl.DateTimeFormat('en-CA', options)
    const parts = formatter.formatToParts(date)

    // Build the formatted date in 'y-m-d h:m' format
    const year = parts.find((p) => p.type === 'year').value
    const month = parts.find((p) => p.type === 'month').value
    const day = parts.find((p) => p.type === 'day').value
    const hour = parts.find((p) => p.type === 'hour').value
    const minute = parts.find((p) => p.type === 'minute').value

    return `${year}-${month}-${day} ${hour}:${minute}`
  } catch (error) {
    console.error('Error formatting date:', error)
    return null
  }
}
