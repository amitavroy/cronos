export interface IInitialProductData {
  name: string
  price: number
  category: string
  description: string
}

export interface IInitialUserData {
  name: string
  email: string
  password?: string
  position: string
  country: string
}

export interface IInitialNotificationData {
  title: string
  message: string
}

export interface ISegmentData {
  name: string
  description: string
}
