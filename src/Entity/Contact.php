<?php

namespace App\Entity;

use App\Entity\Property;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
  /**
   * @var String|null
   * @Assert\NotBlank(message="Ce champs est obligatoire")
   * @Assert\Length(min=2, max=100, minMessage="Le prénom doit faire plus de deux caractères", maxMessage="Le prénom doit faire moins de 100 caractères")
   */
  private $firstname;

  /**
   * @var String|null
   * @Assert\NotBlank(message="Ce champs est obligatoire")
   * @Assert\Length(min=2, max=100, minMessage="Le nom doit faire plus de deux caractères", maxMessage="Le nom doit faire moins de 100 caractères")
   */
  private $lastname;

  /**
   * @var String|null
   * @Assert\NotBlank(message="Ce champs est obligatoire")
   * @Assert\Regex(
   *  pattern="/[0-9]{10}/",
   *  message="Entrez un numéro de téléphone au format : 0123456789"
   * )
   */
  private $phone;

  /**
   * @var String|null
   * @Assert\NotBlank(message="Ce champs est obligatoire")
   * @Assert\Email(message="Le format email ne semble pas valide")
   */
  private $email;

  /**
   * @var String|null
   * @Assert\NotBlank(message="Ce champs est obligatoire")
   * @Assert\Length(min=10, minMessage="Le message doit faire plus de 10 caractères")
   */
  private $message;

  /**
   * The property concerned by the contact message
   *
   * @var Property|null
   */
  private $property;


  /**
   * Get the value of firstname
   *
   * @return  String|null
   */ 
  public function getFirstname()
  {
    return $this->firstname;
  }

  /**
   * Set the value of firstname
   *
   * @param  String|null  $firstname
   *
   * @return  self
   */ 
  public function setFirstname($firstname)
  {
    $this->firstname = $firstname;

    return $this;
  }

  /**
   * Get the value of lastname
   *
   * @return  String|null
   */ 
  public function getLastname()
  {
    return $this->lastname;
  }

  /**
   * Set the value of lastname
   *
   * @param  String|null  $lastname
   *
   * @return  self
   */ 
  public function setLastname($lastname)
  {
    $this->lastname = $lastname;

    return $this;
  }

  /**
   * Get pattern="/[0-9]{10}/",
   *
   * @return  String|null
   */ 
  public function getPhone()
  {
    return $this->phone;
  }

  /**
   * Set pattern="/[0-9]{10}/",
   *
   * @param  String|null  $phone  pattern="/[0-9]{10}/",
   *
   * @return  self
   */ 
  public function setPhone($phone)
  {
    $this->phone = $phone;

    return $this;
  }

  /**
   * Get the value of email
   *
   * @return  String|null
   */ 
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the value of email
   *
   * @param  String|null  $email
   *
   * @return  self
   */ 
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of message
   *
   * @return  String|null
   */ 
  public function getMessage()
  {
    return $this->message;
  }

  /**
   * Set the value of message
   *
   * @param  String|null  $message
   *
   * @return  self
   */ 
  public function setMessage($message)
  {
    $this->message = $message;

    return $this;
  }

  /**
   * Get undocumented variable
   *
   * @return  Property|null
   */ 
  public function getProperty()
  {
    return $this->property;
  }

  /**
   * Set undocumented variable
   *
   * @param  Property|null  $property  Undocumented variable
   *
   * @return  self
   */ 
  public function setProperty($property)
  {
    $this->property = $property;

    return $this;
  }
}