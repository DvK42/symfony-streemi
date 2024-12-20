<?php

namespace App\Entity;

use App\Enum\UserAccountStatusEnum;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $username = null;

  #[ORM\Column(length: 255)]
  private ?string $email = null;

  #[ORM\Column(length: 255)]
  private ?string $password = null;

  private ?string $plainPassword = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $resetPasswordToken = null;

  #[ORM\Column(enumType: UserAccountStatusEnum::class)]
  private ?UserAccountStatusEnum $accountStatus = UserAccountStatusEnum::PENDING;

  #[ORM\ManyToOne(inversedBy: 'users')]
  private ?Subscription $currentSubscription = null;

  // #[ORM\Column(type: "json")]
  // private array $roles = [];

  /**
   * @var Collection<int, Comment>
   */
  #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'user')]
  private Collection $comments;

  /**
   * @var Collection<int, SubscriptionHistory>
   */
  #[ORM\OneToMany(targetEntity: SubscriptionHistory::class, mappedBy: 'user')]
  private Collection $subscriptionHistories;

  /**
   * @var Collection<int, Playlist>
   */
  #[ORM\OneToMany(targetEntity: Playlist::class, mappedBy: 'user')]
  private Collection $playlists;

  /**
   * @var Collection<int, PlaylistSubscription>
   */
  #[ORM\OneToMany(targetEntity: PlaylistSubscription::class, mappedBy: 'user')]
  private Collection $playlistSubscriptions;

  /**
   * @var Collection<int, WatchHistory>
   */
  #[ORM\OneToMany(targetEntity: WatchHistory::class, mappedBy: 'user')]
  private Collection $watchHistories;

  #[ORM\Column]
  private array $roles = [];

  public function __construct()
  {
    $this->comments = new ArrayCollection();
    $this->subscriptionHistories = new ArrayCollection();
    $this->playlists = new ArrayCollection();
    $this->playlistSubscriptions = new ArrayCollection();
    $this->watchHistories = new ArrayCollection();
    $this->roles = [];
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getUsername(): ?string
  {
    return $this->username;
  }

  public function setUsername(string $username): static
  {
    $this->username = $username;

    return $this;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(string $email): static
  {
    $this->email = $email;

    return $this;
  }

  public function getPassword(): ?string
  {
    return $this->password;
  }

  public function setPassword(string $password): static
  {
    $this->password = $password;

    return $this;
  }

  public function getPlainPassword(): ?string
  {
    return $this->plainPassword;
  }

  public function setPlainPassword(string $plainPassword): static
  {
    $this->plainPassword = $plainPassword;

    return $this;
  }

  public function getResetPasswordToken(): ?string
  {
    return $this->resetPasswordToken;
  }

  public function setResetPasswordToken(string $resetPasswordToken): static
  {
    $this->resetPasswordToken = $resetPasswordToken;

    return $this;
  }

  public function getAccountStatus(): ?UserAccountStatusEnum
  {
    return $this->accountStatus;
  }

  public function setAccountStatus(UserAccountStatusEnum $accountStatus): static
  {
    $this->accountStatus = $accountStatus;

    return $this;
  }

  public function getCurrentSubscription(): ?Subscription
  {
    return $this->currentSubscription;
  }

  public function setCurrentSubscription(?Subscription $currentSubscription): static
  {
    $this->currentSubscription = $currentSubscription;

    return $this;
  }

  /**
   * @return Collection<int, Comment>
   */
  public function getComments(): Collection
  {
    return $this->comments;
  }

  public function addComment(Comment $comment): static
  {
    if (!$this->comments->contains($comment)) {
      $this->comments->add($comment);
      $comment->setUser($this);
    }

    return $this;
  }

  public function removeComment(Comment $comment): static
  {
    if ($this->comments->removeElement($comment)) {
      // set the owning side to null (unless already changed)
      if ($comment->getUser() === $this) {
        $comment->setUser(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, SubscriptionHistory>
   */
  public function getSubscriptionHistories(): Collection
  {
    return $this->subscriptionHistories;
  }

  public function addSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
  {
    if (!$this->subscriptionHistories->contains($subscriptionHistory)) {
      $this->subscriptionHistories->add($subscriptionHistory);
      $subscriptionHistory->setUser($this);
    }

    return $this;
  }

  public function removeSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
  {
    if ($this->subscriptionHistories->removeElement($subscriptionHistory)) {
      // set the owning side to null (unless already changed)
      if ($subscriptionHistory->getUser() === $this) {
        $subscriptionHistory->setUser(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, Playlist>
   */
  public function getPlaylists(): Collection
  {
    return $this->playlists;
  }

  public function addPlaylist(Playlist $playlist): static
  {
    if (!$this->playlists->contains($playlist)) {
      $this->playlists->add($playlist);
      $playlist->setUser($this);
    }

    return $this;
  }

  public function removePlaylist(Playlist $playlist): static
  {
    if ($this->playlists->removeElement($playlist)) {
      // set the owning side to null (unless already changed)
      if ($playlist->getUser() === $this) {
        $playlist->setUser(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, PlaylistSubscription>
   */
  public function getPlaylistSubscriptions(): Collection
  {
    return $this->playlistSubscriptions;
  }

  public function addPlaylistSubscription(PlaylistSubscription $playlistSubscription): static
  {
    if (!$this->playlistSubscriptions->contains($playlistSubscription)) {
      $this->playlistSubscriptions->add($playlistSubscription);
      $playlistSubscription->setUser($this);
    }

    return $this;
  }

  public function removePlaylistSubscription(PlaylistSubscription $playlistSubscription): static
  {
    if ($this->playlistSubscriptions->removeElement($playlistSubscription)) {
      // set the owning side to null (unless already changed)
      if ($playlistSubscription->getUser() === $this) {
        $playlistSubscription->setUser(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, WatchHistory>
   */
  public function getWatchHistories(): Collection
  {
    return $this->watchHistories;
  }

  public function addWatchHistory(WatchHistory $watchHistory): static
  {
    if (!$this->watchHistories->contains($watchHistory)) {
      $this->watchHistories->add($watchHistory);
      $watchHistory->setUser($this);
    }

    return $this;
  }

  public function removeWatchHistory(WatchHistory $watchHistory): static
  {
    if ($this->watchHistories->removeElement($watchHistory)) {
      // set the owning side to null (unless already changed)
      if ($watchHistory->getUser() === $this) {
        $watchHistory->setUser(null);
      }
    }

    return $this;
  }

  // Security

  public function getUserIdentifier(): string
  {
    return $this->email;
  }

  public function getRoles(): array
  {
    $roles = $this->roles;
    $roles[] = 'ROLE_USER';
    return array_unique($roles);
    // return $this->roles;
  }

  public function setRoles(array $roles): self
  {
    $this->roles = $roles;
    return $this;
  }

  public function getSalt(): ?string
  {
    return null;
  }

  public function eraseCredentials(): void
  {
  }
}
