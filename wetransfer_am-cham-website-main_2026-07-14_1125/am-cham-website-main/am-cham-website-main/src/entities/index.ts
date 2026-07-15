/**
 * Auto-generated entity types
 * Contains all CMS collection interfaces in a single file 
 */

/**
 * Collection ID: contactinquiries
 * Interface for ContactInquiries
 */
export interface ContactInquiries {
  _id: string;
  _createdDate?: Date;
  _updatedDate?: Date;
  /** @wixFieldType text */
  senderName?: string;
  /** @wixFieldType text */
  emailAddress?: string;
  /** @wixFieldType text */
  phoneNumber?: string;
  /** @wixFieldType text */
  subject?: string;
  /** @wixFieldType text */
  messageContent?: string;
  /** @wixFieldType datetime */
  submissionDate?: Date | string;
}


/**
 * Collection ID: events
 * Interface for Events
 */
export interface Events {
  _id: string;
  _createdDate?: Date;
  _updatedDate?: Date;
  /** @wixFieldType text */
  eventTitle?: string;
  /** @wixFieldType datetime */
  eventDateTime?: Date | string;
  /** @wixFieldType text */
  agenda?: string;
  /** @wixFieldType url */
  registrationLink?: string;
  /** @wixFieldType text */
  eventType?: string;
  /** @wixFieldType text */
  topic?: string;
}


/**
 * Collection ID: memberbenefits
 * Interface for MemberBenefits
 */
export interface MemberBenefits {
  _id: string;
  _createdDate?: Date;
  _updatedDate?: Date;
  /** @wixFieldType text */
  benefitTitle?: string;
  /** @wixFieldType text */
  description?: string;
  /** @wixFieldType image - Contains image URL, render with <Image> component, NOT as text */
  benefitImage?: string;
  /** @wixFieldType text */
  category?: string;
  /** @wixFieldType boolean */
  isPremium?: boolean;
  /** @wixFieldType url */
  learnMoreUrl?: string;
}


/**
 * Collection ID: resources
 * Interface for Resources
 */
export interface Resources {
  _id: string;
  _createdDate?: Date;
  _updatedDate?: Date;
  /** @wixFieldType text */
  title?: string;
  /** @wixFieldType text */
  description?: string;
  /** @wixFieldType url */
  resourceLink?: string;
  /** @wixFieldType text */
  category?: string;
  /** @wixFieldType date */
  publicationDate?: Date | string;
  /** @wixFieldType text */
  authorSource?: string;
  /** @wixFieldType image - Contains image URL, render with <Image> component, NOT as text */
  thumbnail?: string;
}
