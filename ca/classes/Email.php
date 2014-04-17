<?php
/**
 *
 * @author Sakkeer Hussain
 */
class Email {
    


public static function sentEmail($_to,$_subject,$_text)
   {    
      // Recipient's email ID is in String to.
      
      // Sender's email ID needs to be mentioned
      $_from = "web@gmail.com";

      // Assuming you are sending email from localhost
      $_host = "localhost";

      // Get system properties
      Properties properties = System.getProperties();

      // Setup mail server
      properties.setProperty("mail.smtp.host", host);

      // Get the default Session object.
      Session session = Session.getDefaultInstance(properties);

      try{
         // Create a default MimeMessage object.
         MimeMessage message = new MimeMessage(session);

         // Set From: header field of the header.
         message.setFrom(new InternetAddress(from));

         // Set To: header field of the header.
         message.addRecipient(Message.RecipientType.TO,
                                  new InternetAddress(to));

         // Set Subject: header field
         message.setSubject(subject);

         // Now set the actual message
         message.setText(text);

         // Send message
         Transport.send(message);
         System.out.println("Sent message successfully....");
      }catch (MessagingException mex) {
         mex.printStackTrace();
      }
   }
}
