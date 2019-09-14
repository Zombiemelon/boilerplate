pipeline {
    options { timeout(time: 25, unit: 'MINUTES') }
    agent any
    environment {
        CONTAINER_NAME='inex'
        ECR_ADDRESS='276242186269.dkr.ecr.eu-central-1.amazonaws.com/inex'
    }
    stages {
//         stage ('Build Back') {
//             steps {
//                 sh 'ls -alh'
//                 sh 'docker build -t $CONTAINER_NAME:back -f ./docker/Dockerfile.staging.backend .'
//                 sh '$(/root/.local/bin/aws ecr get-login --no-include-email --region eu-central-1)'
//                 sh 'docker tag $CONTAINER_NAME:back $ECR_ADDRESS:back'
//                 sh 'docker push $ECR_ADDRESS'
//                 sh 'echo "Delete image"'
//                 sh 'docker image rm -f ${CONTAINER_NAME}:back && docker image prune -f'
//             }
//         }
//         stage ('Build Front') {
//             steps {
//                 sh 'docker build -t $CONTAINER_NAME:front -f ./docker/Dockerfile.staging.frontend . '
//                 sh '$(/root/.local/bin/aws ecr get-login --no-include-email --region eu-central-1)'
//                 sh 'docker tag $CONTAINER_NAME:front $ECR_ADDRESS:front'
//                 sh 'docker push $ECR_ADDRESS:front'
//                 sh 'echo "Delete image"'
//                 sh 'docker image rm -f ${CONTAINER_NAME}:front && docker image prune -f'
//             }
//         }
        stage('Deploy') {
            steps {
                sshPublisher(publishers: [sshPublisherDesc(configName: 'deploy', transfers: [sshTransfer(cleanRemote: false, excludes: '', execCommand: "\$(aws ecr get-login --no-include-email --region eu-central-1) && docker pull ${ECR_ADDRESS}:back && docker pull ${ECR_ADDRESS}:front && docker rm -f delta_dashboard_backend && docker rm -f delta_dashboard_frontend ; docker run --name delta_dashboard_backend -d -p 8002:80 ${ECR_ADDRESS}:back && docker run --name delta_dashboard_frontend -d -p 4000:80 ${ECR_ADDRESS}:front", execTimeout: 120000, flatten: false, makeEmptyDirs: false, noDefaultExcludes: false, patternSeparator: '[, ]+', remoteDirectory: '', remoteDirectorySDF: false, removePrefix: '', sourceFiles: '')], usePromotionTimestamp: false, useWorkspaceInPromotion: false, verbose: false)])
            }
        }
    }
    post {
        always {
            cleanWs()
            sh 'docker system prune -f'
        }
    }
}