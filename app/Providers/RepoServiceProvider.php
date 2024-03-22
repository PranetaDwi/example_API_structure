<?php

namespace App\Providers;

use App\Repository\Agent\AgentRepository;
use App\Repository\Agent\AgentRepositoryImpl;
use App\Repository\AgentLanguage\AgentLanguageRepository;
use App\Repository\AgentLanguage\AgentLanguageRepositoryImpl;
use App\Repository\AgentMessage\AgentMessageRepository;
use App\Repository\AgentMessage\AgentMessageRepositoryImpl;
use App\Repository\AgentSpecialist\AgentSpecialistRepository;
use App\Repository\AgentSpecialist\AgentSpecialistRepositoryImpl;
use App\Repository\Developer\DeveloperRepository;
use App\Repository\Developer\DeveloperRepositoryImpl;
use App\Repository\DeveloperMessage\DeveloperMessageRepository;
use App\Repository\DeveloperMessage\DeveloperMessageRepositoryImpl;
use App\Repository\FacilityType\FacilityTypeRepository;
use App\Repository\FacilityType\FacilityTypeRepositoryImpl;
use App\Repository\InfrastructureType\InfrastructureTypeRepository;
use App\Repository\InfrastructureType\InfrastructureTypeRepositoryImpl;
use App\Repository\Project\ProjectRepository;
use App\Repository\Project\ProjectRepositoryImpl;
use App\Repository\ProjectDocument\ProjectDocumentRepository;
use App\Repository\ProjectDocument\ProjectDocumentRepositoryImpl;
use App\Repository\ProjectFacility\ProjectFacilityRepository;
use App\Repository\ProjectFacility\ProjectFacilityRepositoryImpl;
use App\Repository\ProjectFavorite\ProjectFavoriteRepository;
use App\Repository\ProjectFavorite\ProjectFavoriteRepositoryImpl;
use App\Repository\ProjectInfrastructure\ProjectInfrastructureRepository;
use App\Repository\ProjectInfrastructure\ProjectInfrastructureRepositoryImpl;
use App\Repository\ProjectLead\ProjectLeadRepository;
use App\Repository\ProjectLead\ProjectLeadRepositoryImpl;
use App\Repository\ProjectPhoto\ProjectPhotoRepository;
use App\Repository\ProjectPhoto\ProjectPhotoRepositoryImpl;
use App\Repository\ProjectVideo\ProjectVideoRepository;
use App\Repository\ProjectVideo\ProjectVideoRepositoryImpl;
use App\Repository\ProjectView\ProjectViewRepository;
use App\Repository\ProjectView\ProjectViewRepositoryImpl;
use App\Repository\ProjectVirtualTour\ProjectVirtualTourRepository;
use App\Repository\ProjectVirtualTour\ProjectVirtualTourRepositoryImpl;
use App\Repository\Property\PropertyRepository;
use App\Repository\Property\PropertyRepositoryImpl;
use App\Repository\PropertyDetail\PropertyDetailRepository;
use App\Repository\PropertyDetail\PropertyDetailRepositoryImpl;
use App\Repository\PropertyFacility\PropertyFacilityRepository;
use App\Repository\PropertyFacility\PropertyFacilityRepositoryImpl;
use App\Repository\PropertyFavorite\PropertyFavoriteRepository;
use App\Repository\PropertyFavorite\PropertyFavoriteRepositoryImpl;
use App\Repository\PropertyLead\PropertyLeadRepository;
use App\Repository\PropertyLead\PropertyLeadRepositoryImpl;
use App\Repository\PropertyPhoto\PropertyPhotoRepository;
use App\Repository\PropertyPhoto\PropertyPhotoRepositoryImpl;
use App\Repository\PropertyType\PropertyTypeRepository;
use App\Repository\PropertyType\PropertyTypeRepositoryImpl;
use App\Repository\PropertyVideo\PropertyVideoRepository;
use App\Repository\PropertyVideo\PropertyVideoRepositoryImpl;
use App\Repository\PropertyView\PropertyViewRepository;
use App\Repository\PropertyView\PropertyViewRepositoryImpl;
use App\Repository\PropertyVirtualTour\PropertyVirtualTourRepository;
use App\Repository\PropertyVirtualTour\PropertyVirtualTourRepositoryImpl;
use App\Repository\Unit\UnitRepository;
use App\Repository\Unit\UnitRepositoryImpl;
use App\Repository\UnitDocument\UnitDocumentRepository;
use App\Repository\UnitDocument\UnitDocumentRepositoryImpl;
use App\Repository\UnitModel\UnitModelRepository;
use App\Repository\UnitModel\UnitModelRepositoryImpl;
use App\Repository\UnitPhoto\UnitPhotoRepository;
use App\Repository\UnitPhoto\UnitPhotoRepositoryImpl;
use App\Repository\UnitVideo\UnitVideoRepository;
use App\Repository\UnitVideo\UnitVideoRepositoryImpl;
use App\Repository\UnitVirtualTour\UnitVirtualTourRepository;
use App\Repository\UnitVirtualTour\UnitVirtualTourRepositoryImpl;
use App\Repository\User\UserRepository;
use App\Repository\User\UserRepositoryImpl;
use App\Repository\UserData\UserDataRepository;
use App\Repository\UserData\UserDataRepositoryImpl;
use App\Repository\Monitoring\MonitoringRepository;
use App\Repository\Monitoring\MonitoringRepositoryImpl;
use App\Repository\ProjectProgress\ProjectProgressRepository;
use App\Repository\ProjectProgress\ProjectProgressRepositoryImpl;
use App\Repository\Progress\ProgressRepository;
use App\Repository\Progress\ProgressRepositoryImpl;
use App\Repository\ProgressPicture\ProgressPictureRepository;
use App\Repository\ProgressPicture\ProgressPictureRepositoryImpl;
use App\Repository\Chat\ChatRepository;
use App\Repository\Chat\ChatRepositoryImpl;

use App\Service\Auth\AuthService;
use App\Service\Auth\AuthServiceImpl;
use App\Service\CMS\Admin\AccountManagement\AccountManagementService;
use App\Service\CMS\Admin\AccountManagement\AccountManagementServiceImpl;
use App\Service\CMS\Admin\FacilityTypeManagement\FacilityTypeManagementService;
use App\Service\CMS\Admin\FacilityTypeManagement\FacilityTypeManagementServiceImpl;
use App\Service\CMS\Admin\InfrastructureTypeManagement\InfrastructureTypeManagementService;
use App\Service\CMS\Admin\InfrastructureTypeManagement\InfrastructureTypeManagementServiceImpl;
use App\Service\CMS\Admin\PropertyTypeManagement\PropertyTypeManagementService;
use App\Service\CMS\Admin\PropertyTypeManagement\PropertyTypeManagementServiceImpl;
use App\Service\CMS\Agent\AgentManagement\AgentManagementService;
use App\Service\CMS\Agent\AgentManagement\AgentManagementServiceImpl;
use App\Service\CMS\Agent\PropertyManagement\PropertyManagementService;
use App\Service\CMS\Agent\PropertyManagement\PropertyManagementServiceImpl;
use App\Service\CMS\Common\Dashboard\DashboardService;
use App\Service\CMS\Common\Dashboard\DashboardServiceImpl;
use App\Service\CMS\Common\Message\MessageService;
use App\Service\CMS\Common\Message\MessageServiceImpl;
use App\Service\CMS\Common\ProfileManagement\ProfileManagementService;
use App\Service\CMS\Common\ProfileManagement\ProfileManagementServiceImpl;
use App\Service\CMS\Developer\DeveloperManagement\DeveloperManagementService;
use App\Service\CMS\Developer\DeveloperManagement\DeveloperManagementServiceImpl;
use App\Service\CMS\Developer\ProjectManagement\ProjectManagementService;
use App\Service\CMS\Developer\ProjectManagement\ProjectManagementServiceImpl;
use App\Service\CMS\Developer\UnitManagement\UnitManagementService;
use App\Service\CMS\Developer\UnitManagement\UnitManagementServiceImpl;
use App\Service\Public\Agent\PublicAgentService;
use App\Service\Public\Agent\PublicAgentServiceImpl;
use App\Service\Public\Developer\PublicDeveloperService;
use App\Service\Public\Developer\PublicDeveloperServiceImpl;
use App\Service\Public\Homepage\HomepageService;
use App\Service\Public\Homepage\HomepageServiceImpl;
use App\Service\Public\Project\PublicProjectService;
use App\Service\Public\Project\PublicProjectServiceImpl;
use App\Service\Public\Property\PublicPropertyService;
use App\Service\Public\Property\PublicPropertyServiceImpl;
use App\Service\Public\Unit\PublicUnitService;
use App\Service\Public\Unit\PublicUnitServiceImpl;
use App\Service\User\UserService;
use App\Service\User\UserServiceImpl;
use Illuminate\Support\ServiceProvider;
use App\Service\Monitoring\Integration\IntegrasiMonitoringService;
use App\Service\Monitoring\Integration\IntegrasiMonitoringServiceImpl;
use App\Service\Monitoring\Project\User\UserMonitoringService;
use App\Service\Monitoring\Project\User\UserMonitoringServiceImpl;
use App\Service\Monitoring\Project\Developer\ProjectProgressService;
use App\Service\Monitoring\Project\Developer\ProjectProgressServiceImpl;
use App\Service\Monitoring\Project\Developer\Progress\ProgressService;
use App\Service\Monitoring\Project\Developer\Progress\ProgressServiceImpl;
use App\Service\Monitoring\Chat\ChatService;
use App\Service\Monitoring\Chat\ChatServiceImpl;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(UserDataRepository::class, UserDataRepositoryImpl::class);
        $this->app->bind(AgentRepository::class, AgentRepositoryImpl::class);
        $this->app->bind(DeveloperRepository::class, DeveloperRepositoryImpl::class);
        $this->app->bind(PropertyTypeRepository::class, PropertyTypeRepositoryImpl::class);
        $this->app->bind(FacilityTypeRepository::class, FacilityTypeRepositoryImpl::class);
        $this->app->bind(InfrastructureTypeRepository::class, InfrastructureTypeRepositoryImpl::class);
        $this->app->bind(PropertyRepository::class, PropertyRepositoryImpl::class);
        $this->app->bind(PropertyDetailRepository::class, PropertyDetailRepositoryImpl::class);
        $this->app->bind(PropertyPhotoRepository::class, PropertyPhotoRepositoryImpl::class);
        $this->app->bind(PropertyVideoRepository::class, PropertyVideoRepositoryImpl::class);
        $this->app->bind(PropertyVirtualTourRepository::class, PropertyVirtualTourRepositoryImpl::class);
        $this->app->bind(PropertyFacilityRepository::class, PropertyFacilityRepositoryImpl::class);
        $this->app->bind(PropertyFavoriteRepository::class, PropertyFavoriteRepositoryImpl::class);
        $this->app->bind(PropertyViewRepository::class, PropertyViewRepositoryImpl::class);
        $this->app->bind(PropertyLeadRepository::class, PropertyLeadRepositoryImpl::class);
        $this->app->bind(ProjectRepository::class, ProjectRepositoryImpl::class);
        $this->app->bind(DeveloperMessageRepository::class, DeveloperMessageRepositoryImpl::class);
        $this->app->bind(AgentMessageRepository::class, AgentMessageRepositoryImpl::class);
        $this->app->bind(ProjectPhotoRepository::class, ProjectPhotoRepositoryImpl::class);
        $this->app->bind(ProjectVideoRepository::class, ProjectVideoRepositoryImpl::class);
        $this->app->bind(ProjectVirtualTourRepository::class, ProjectVirtualTourRepositoryImpl::class);
        $this->app->bind(ProjectDocumentRepository::class, ProjectDocumentRepositoryImpl::class);
        $this->app->bind(ProjectFacilityRepository::class, ProjectFacilityRepositoryImpl::class);
        $this->app->bind(ProjectInfrastructureRepository::class, ProjectInfrastructureRepositoryImpl::class);
        $this->app->bind(ProjectFavoriteRepository::class, ProjectFavoriteRepositoryImpl::class);
        $this->app->bind(ProjectLeadRepository::class, ProjectLeadRepositoryImpl::class);
        $this->app->bind(ProjectViewRepository::class, ProjectViewRepositoryImpl::class);
        $this->app->bind(UnitRepository::class, UnitRepositoryImpl::class);
        $this->app->bind(UnitDocumentRepository::class, UnitDocumentRepositoryImpl::class);
        $this->app->bind(UnitModelRepository::class, UnitModelRepositoryImpl::class);
        $this->app->bind(UnitPhotoRepository::class, UnitPhotoRepositoryImpl::class);
        $this->app->bind(UnitVideoRepository::class, UnitVideoRepositoryImpl::class);
        $this->app->bind(UnitVirtualTourRepository::class, UnitVirtualTourRepositoryImpl::class);
        $this->app->bind(AgentSpecialistRepository::class, AgentSpecialistRepositoryImpl::class);
        $this->app->bind(AgentLanguageRepository::class, AgentLanguageRepositoryImpl::class);
        $this->app->bind(MonitoringRepository::class, MonitoringRepositoryImpl::class);
        $this->app->bind(ProjectProgressRepository::class, ProjectProgressRepositoryImpl::class);
        $this->app->bind(ProgressRepository::class, ProgressRepositoryImpl::class);
        $this->app->bind(ProgressPictureRepository::class, ProgressPictureRepositoryImpl::class);
        $this->app->bind(ChatRepository::class, ChatRepositoryImpl::class);

        $this->app->bind(AuthService::class, AuthServiceImpl::class);
        $this->app->bind(AccountManagementService::class, AccountManagementServiceImpl::class);
        $this->app->bind(PropertyTypeManagementService::class, PropertyTypeManagementServiceImpl::class);
        $this->app->bind(InfrastructureTypeManagementService::class, InfrastructureTypeManagementServiceImpl::class);
        $this->app->bind(FacilityTypeManagementService::class, FacilityTypeManagementServiceImpl::class);
        $this->app->bind(PropertyManagementService::class, PropertyManagementServiceImpl::class);
        $this->app->bind(ProfileManagementService::class, ProfileManagementServiceImpl::class);
        $this->app->bind(DashboardService::class, DashboardServiceImpl::class);
        $this->app->bind(MessageService::class, MessageServiceImpl::class);
        $this->app->bind(ProjectManagementService::class, ProjectManagementServiceImpl::class);
        $this->app->bind(UnitManagementService::class, UnitManagementServiceImpl::class);
        $this->app->bind(PublicAgentService::class, PublicAgentServiceImpl::class);
        $this->app->bind(PublicPropertyService::class, PublicPropertyServiceImpl::class);
        $this->app->bind(PublicProjectService::class, PublicProjectServiceImpl::class);
        $this->app->bind(PublicUnitService::class, PublicUnitServiceImpl::class);
        $this->app->bind(PublicDeveloperService::class, PublicDeveloperServiceImpl::class);
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(HomepageService::class, HomepageServiceImpl::class);
        $this->app->bind(AgentManagementService::class, AgentManagementServiceImpl::class);
        $this->app->bind(DeveloperManagementService::class, DeveloperManagementServiceImpl::class);
        $this->app->bind(IntegrasiMonitoringService::class, IntegrasiMonitoringServiceImpl::class);
        $this->app->bind(UserMonitoringService::class, UserMonitoringServiceImpl::class);
        $this->app->bind(ProjectProgressService::class, ProjectProgressServiceImpl::class);
        $this->app->bind(ProgressService::class, ProgressServiceImpl::class);
        $this->app->bind(ChatService::class, ChatServiceImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
